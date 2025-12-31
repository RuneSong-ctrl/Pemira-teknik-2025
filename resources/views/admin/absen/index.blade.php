@extends('/admin/layouts/master', ['title' => 'Absen'])

@section('content')
    <style>
        .modal-backdrop {
            z-index: 2000 !important;
        }
        .modal {
            z-index: 2001 !important;
        }
    </style>

    <div ui-view class="app-body" id="view">
        <div class="padding">
            <div class="box">
                <div class="box-header">
                    <h4 style="position: relative;top:10px">Absen Mahasiswa</h4>
                </div>
                <hr>
                <div class="p-3">
                    <table id="absen" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Program Studi</th>
                                <th>Waktu Memilih</th>
                                <th>SMFT</th>
                                <th>BPMFT</th>
                                @if (Auth::user()->hasRole('admin'))
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['nama_prodi'] }}</td>
                                    <td>{{ $item['waktu_memilih'] }}</td>
                                    
                                    {{-- Langsung tampilkan nama dari controller --}}
                                    <td>{{ $item['smft'] ?? '-' }}</td>
                                    <td>{{ $item['bpmft'] ?? '-' }}</td>

                                    @if (Auth::user()->hasRole('admin'))
                                        <td class="text-center">
                                            <button type="button" class="reset btn btn-danger btn-sm"
                                                data-id="{{ $item['mahasiswa_id'] }}" 
                                                data-nama="{{ $item['name'] }}"
                                                data-toggle="modal" 
                                                data-target="#myModal">
                                                Reset Suara
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="myModalLabel">Reset Confirmation</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p class="error-text">
                        <i class="fa fa-warning modal-icon"></i>
                        Apakah anda yakin ingin mereset suara user: <br>
                        <b id="nama-mhs-modal" style="font-size: 1.2em"></b> ?
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="modalReset" action="#" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var d = day + "-" + month + "-" + year;

            var table = $('#absen').DataTable({
                ordering: true,
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn btn-danger',
                    text: 'Export to excel',
                    title: 'ABSEN MUSMA TEKNIK - ' + d,
                    filename: 'absen musma - ' + d,
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button')
                    },
                    exportOptions: {
                        rows: { search: 'applied' },
                        orthogonal: 'export',
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }],
            });

            $('#myModal').appendTo("body");

            $('body').on('click', '.reset', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                
                $('#nama-mhs-modal').text(nama);
                $('#modalReset').attr('action', '/admin/absen/reset/' + id);
            });
        });
    </script>
@endsection