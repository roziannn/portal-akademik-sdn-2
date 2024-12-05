<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id_user' => 1,
            'name' => 'Admin Sekolah',
            'email' => 'admin@gmail.com',
            'created_by' => 'default',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
