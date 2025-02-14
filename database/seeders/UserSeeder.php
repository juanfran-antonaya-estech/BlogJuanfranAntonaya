<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(5)
            ->hasPosts(10)
            ->hasCommments(10)
            ->hasProductos(10)->create();
        User::factory([
            'name' => 'Admin',
            'email' => 'ejemploadmin@gmail.com',
            'password' => Hash::make('developino'),
            'role' => 2
        ])->create();
        User::factory([
            'name' => 'Usuario',
            'email' => 'ejemplouser@gmail.com',
            'password' => Hash::make('userino'),
            'role' => 10
        ])->create();
    }
}
