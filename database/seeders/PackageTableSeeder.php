<?php

namespace Database\Seeders;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
                [
                    'name' => 'بكالوريا علمي',
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addMonth(),
                    'image' => asset('images/packages/default.png'),
                ],
            [
                'name' => 'بكالوريا أدبي',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'image' => asset('images/packages/default.png'),
            ],
            [
                'name' => 'حادي عشر علمي',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'image' => asset('images/packages/default.png'),
            ],
        ];
        foreach ($packages as $package)
        {
            Package::create($package);
        }
    }
}
