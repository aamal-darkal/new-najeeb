<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'user_name' => 'Admin',
            'password' => Hash::make('najFor@llStudents'),
            'role' => 'admin',
            'token_birth' => Carbon::now(),
            'remember_token' => null,
        ];
        User::create($admin);
    }
}
