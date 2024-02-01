<?php

namespace Database\Seeders;

use App\Models\Lecture;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lectures = [
            // [
            //     'week_program_id' => 1,
            //     'name' => 'النواس المرن',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 7,
            // ],
            // [
            //     'week_program_id' => 2,
            //     'name' => 'الكيمياء العضوية',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 8,
            // ],
            // [
            //     'week_program_id' => 3,
            //     'name' => 'الاحتمالات',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 6,
            // ],
            // [
            //     'week_program_id' => 4,
            //     'name' => 'الدولة العثمانية',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 4,
            // ],
            // [
            //     'week_program_id' => 5,
            //     'name' => 'حدود بلاد الشام',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 4,
            // ],
            // [
            //     'week_program_id' => 6,
            //     'name' => 'العقدية',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 3,
            // ],
            // [
            //     'week_program_id' => 7,
            //     'name' => 'ميكانيك السوائل',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 1,
            // ],
            // [
            //     'week_program_id' => 8,
            //     'name' => 'الهالوجينات',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 1,
            // ],
            // [
            //     'week_program_id' => 9,
            //     'name' => 'Past simple',
            //     'video_link' => 'https://www.youtube.com/watch?v=UK8e9gm6mYs',
            //     'date' => Carbon::now(),
            //     'duration' => 40,
            //     'subject_id' => 9,
            // ],
        ];

        foreach ($lectures as $lecture) {
            Lecture::create($lecture);
        }
    }
}
