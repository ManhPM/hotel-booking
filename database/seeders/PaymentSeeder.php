<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['amount' => '4000000', 'type' => 'all', 'payment_date' => '2024-07-05', 'payment_method_id' => '1', 'booking_id' => '2'],
            ['amount' => '4000000', 'type' => 'partial', 'payment_date' => '2024-07-05', 'payment_method_id' => '1', 'booking_id' => '1'],
        ];

        foreach ($items as $item) {
            Payment::updateOrCreate($item);
        }
    }
}
