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
        $users = [
            [
                'id' => 1,
                'mobile' => 'admin',
                'password' => Hash::make('najFor@llStudents'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'mobile' => '0932333090',
                'password' => Hash::make('123456'),
                'role' => 'student',
            ]
        ];
        User::insert($users);
    }
}
