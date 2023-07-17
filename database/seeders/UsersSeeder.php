<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criando um usuario
        User::create([
          'name' => 'Honorio Crispim', 
          'email' => 'hcrispim@gmail.com',
          'password' => bcrypt('123456'),
        ]);
    }
}
