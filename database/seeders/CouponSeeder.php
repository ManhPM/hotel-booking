<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'SALE05', 'type' => 'money', 'value' => '5', 'expery_date' => '2024-09-09'],
            ['name' => 'SALE10', 'type' => 'money', 'value' => '10', 'expery_date' => '2024-09-09'],
            ['name' => 'SALE15', 'type' => 'money', 'value' => '15', 'expery_date' => '2024-09-09'],
            ['name' => 'SALE20', 'type' => 'money', 'value' => '20', 'expery_date' => '2024-09-09'],
        ];

        foreach ($items as $item) {
            Coupon::updateOrCreate($item);
        }
    }
}
