<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawans')->insert([
            [
                'nama' => 'John Doe',
                'jabatan' => 'Developer',
                'gaji' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jane Smith',
                'jabatan' => 'Manager',
                'gaji' => 8000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mark Taylor',
                'jabatan' => 'Tester',
                'gaji' => 4000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
