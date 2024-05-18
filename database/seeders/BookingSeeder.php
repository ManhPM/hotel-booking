<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['check_in_date' => '2024-07-07', 'check_out_date' => '2024-07-10', 'total' => '5000000', 'status' => 'pending', 'payment_status' => 'partial', 'user_id' => 1, 'room_id' => '1'],
            ['check_in_date' => '2024-07-07', 'check_out_date' => '2024-07-10', 'total' => '4000000', 'status' => 'confirmed', 'payment_status' => 'paid', 'user_id' => 1, 'room_id' => '2'],
            ['check_in_date' => '2024-07-07', 'check_out_date' => '2024-07-10', 'total' => '3000000', 'status' => 'canceled', 'payment_status' => 'unpaid', 'user_id' => 1, 'room_id' => '3'],
        ];

        foreach ($items as $item) {
            Booking::updateOrCreate($item);
        }
    }
}
