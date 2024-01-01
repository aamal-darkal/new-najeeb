<?php

namespace Database\Seeders;

use App\Models\WeekProgram;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeekProgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'subject_id' => 1,
                'start_time' => Carbon::createFromFormat('g:i A', '07:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '08:00 AM'),
                'day' => 'sunday',
            ],
            [
                'subject_id' => 2,
                'start_time' => Carbon::createFromFormat('g:i A', '08:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '09:00 AM'),
                'day' => 'monday',
            ],
            [
                'subject_id' => 3,
                'start_time' => Carbon::createFromFormat('g:i A', '09:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '10:00 AM'),
                'day' => 'monday',
            ],
            [
                'subject_id' => 4,
                'start_time' => Carbon::createFromFormat('g:i A', '08:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '09:00 AM'),
                'day' => 'tuesday',
            ],
            [
                'subject_id' => 5,
                'start_time' => Carbon::createFromFormat('g:i A', '11:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '12:00 PM'),
                'day' => 'wednesday',
            ],
            [
                'subject_id' => 6,
                'start_time' => Carbon::createFromFormat('g:i A', '01:00 PM'),
                'end_time' => Carbon::createFromFormat('g:i A', '02:00 PM'),
                'day' => 'wednesday',
            ],
            [
                'subject_id' => 7,
                'start_time' => Carbon::createFromFormat('g:i A', '02:00 PM'),
                'end_time' => Carbon::createFromFormat('g:i A', '03:00 PM'),
                'day' => 'wednesday',
            ],
            [
                'subject_id' => 8,
                'start_time' => Carbon::createFromFormat('g:i A', '07:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '08:00 AM'),
                'day' => 'thursday',
            ],
            [
                'subject_id' => 9,
                'start_time' => Carbon::createFromFormat('g:i A', '10:00 AM'),
                'end_time' => Carbon::createFromFormat('g:i A', '11:00 AM'),
                'day' => 'thursday',
            ],
        ];

        foreach ($programs as $program) {
            WeekProgram::create($program);
        }
    }
}
