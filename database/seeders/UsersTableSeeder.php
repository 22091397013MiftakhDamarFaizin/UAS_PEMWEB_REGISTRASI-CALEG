<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data pengguna
        $users = [
            ['username' => 'PDI PERJUANGAN',  'password' => '123'],
            ['username' => 'GERINDRA',  'password' => '123'],
            ['username' => 'PAN',  'password' => '123'],
            ['username' => 'PKB',  'password' => '123'],
            ['username' => 'GOLKAR',  'password' => '123'],
            ['username' => 'NASDEM',  'password' => '123'],
            ['username' => 'PSI',  'password' => '123'],
            // Tambahkan data pengguna lain sesuai kebutuhan
        ];

        // Masukkan data pengguna ke dalam tabel
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
