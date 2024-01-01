<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'package_id' => '1',
                'name' => 'فيزياء',
                'cost' => '35000',
            ],
            [
                'package_id' => '1',
                'name' => 'كيمياء',
                'cost' => '30000',
            ],
            [
                'package_id' => '1',
                'name' => 'رياضيات',
                'cost' => '40000',
            ],
            [
                'package_id' => '2',
                'name' => 'تاريخ',
                'cost' => '35000',
            ],
            [
                'package_id' => '2',
                'name' => 'جغرافيا',
                'cost' => '35000',
            ],
            [
                'package_id' => '3',
                'name' => 'رياضيات',
                'cost' => '25000',
            ],
            [
                'package_id' => '3',
                'name' => 'فيزياء',
                'cost' => '20000',
            ],
            [
                'package_id' => '3',
                'name' => 'كيمياء',
                'cost' => '20000',
            ],
            [
                'package_id' => '3',
                'name' => 'انجليزي',
                'cost' => '15000',
            ],
        ];
        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
