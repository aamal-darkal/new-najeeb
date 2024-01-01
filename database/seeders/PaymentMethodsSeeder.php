<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'cash' ],
            ['name' => 'Syriatel Cash' ],
            ['name' => 'MTN Cash' ],
        ];
        foreach($paymentMethods as $paymentMethod)
            PaymentMethod::create($paymentMethod);

    }
}
