<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $students = [
            1 =>
            [

                'first_name' => 'first',
                'last_name' => 'student',
                'phone' => '0937731517',
                'land_line' => '8823568',
                'father_name' => 'dad1',
                'parent_phone' => '0937731517',
                'governorate' => 1

            ],
            2=>
            [

                'first_name' => 'second',
                'last_name' => 'student',
                'phone' => '0935896587',
                'land_line' => '9965874',
                'father_name' => 'dad2',
                'parent_phone' => '0935896587',
                'governorate' => 2
            ],
            3 =>
            [

                'first_name' => 'third',
                'last_name' => 'student',
                'phone' => '0963269856',
                'land_line' => '7758622',
                'father_name' => 'dad3',
                'parent_phone' => '0963269856',
                'governorate' => 1
            ],
        ];
        foreach ($students as $student)
        {
            Student::create($student);
        }
    }
}
