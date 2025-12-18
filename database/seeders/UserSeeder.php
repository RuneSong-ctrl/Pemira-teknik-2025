<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        
        $admin = User::firstOrCreate(
            ['nim' => '999999999'], 
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), 
                'prodi_id' => null,
            ]
        );

        $admin->assignRole('admin');
    }
}