<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Suara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class AbsenController extends Controller
{
    public function index()
    {
        $absen = DB::table('mahasiswas')
            ->select(
                'mahasiswas.id as mahasiswa_id',
                'users.nim',
                'users.name',
                'prodis.nama_prodi',
                'mahasiswas.status',
                'suaras.created_at as waktu_memilih',
                'calons.nama_panggilan as nama_calon', 
                'calons.jenis_calon' 
            )
            ->where('status', 'voted')
            ->join('users', 'mahasiswas.user_id', '=', 'users.id')
            ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
            ->join('suaras', 'mahasiswas.id', '=', 'suaras.mahasiswa_id')
            ->join('calons', 'suaras.calon_id', '=', 'calons.id') 
            ->orderBy('users.nim', 'asc')
            ->get();
            
        $groupedAbsen = $absen->groupBy('mahasiswa_id');

        $processedAbsen = $groupedAbsen->map(function ($group) {
            return $group->reduce(function ($carry, $item) {
                
                if ($item->jenis_calon == 'SMFT') {
                    $carry['smft'] = $item->nama_calon; 
                } elseif ($item->jenis_calon == 'BPMFT') {
                    $carry['bpmft'] = $item->nama_calon;
                }

                $carry['mahasiswa_id'] = $item->mahasiswa_id;
                $carry['nim'] = $item->nim;
                $carry['name'] = $item->name;
                $carry['nama_prodi'] = $item->nama_prodi;
                $carry['waktu_memilih'] = $item->waktu_memilih;
                
                return $carry;
            }, []);
        });

        $absen = $processedAbsen->values()->all();

        return view('admin/absen/index', compact('absen'));
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('admin')) {
            Suara::where('mahasiswa_id', $id)->delete();

            $mahasiswa = Mahasiswa::find($id);
            
            if ($mahasiswa) {
                $mahasiswa->status = 'terverifikasi';
                $mahasiswa->save();
            }

            return redirect('admin/absen');
        }
    }
}