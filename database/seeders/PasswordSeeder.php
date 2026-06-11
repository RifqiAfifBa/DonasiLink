<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordSeeder extends Seeder
{
    public function run(): void
    {
        // Set password admin
        DB::table('admin')->where('username', 'admin')->update([
            'password' => Hash::make('admin123'),
        ]);

        // Set password semua shelter
        DB::table('shelter')->where('id', 1)->update([
            'username' => 'pakansehat',
            'password' => Hash::make('shelter123'),
        ]);
        DB::table('shelter')->where('id', 2)->update([
            'username' => 'hamilsehat',
            'password' => Hash::make('shelter123'),
        ]);
        DB::table('shelter')->where('id', 3)->update([
            'username' => 'vitaminbulanan',
            'password' => Hash::make('shelter123'),
        ]);

        // Set password semua donatur
        DB::table('donatur')->update([
            'password' => Hash::make('donatur123'),
        ]);

        $this->command->info('✅ Semua password berhasil diset!');
        $this->command->table(
            ['Role', 'Username / Email', 'Password'],
            [
                ['Admin',   'admin',          'admin123'],
                ['Shelter', 'pakansehat',     'shelter123'],
                ['Shelter', 'hamilsehat',     'shelter123'],
                ['Shelter', 'vitaminbulanan', 'shelter123'],
                ['Donatur', 'bayu / bayu123@gmail.com', 'donatur123'],
                ['Donatur', 'donatur_test / donatur@test.com', 'donatur123'],
            ]
        );
    }
}
