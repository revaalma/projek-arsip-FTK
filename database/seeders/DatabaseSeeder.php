<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat akun Admin
        User::create([
    'name' => 'Admin FTK',
    'username' => 'admin',
    'password' => Hash::make('password123'),
    ]);

        // 2. Memasukkan 4 Kategori Arsip
        $categories = [
            ['name' => 'Pendidikan', 'slug' => 'pendidikan'],
            ['name' => 'Keuangan', 'slug' => 'keuangan'],
            ['name' => 'SDM & Organisasi', 'slug' => 'sdm-organisasi'],
            ['name' => 'Kerjasama & Kealumnian', 'slug' => 'kerjasama-kealumnian'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}