<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Ví điện tử VNPAY'],
            ['name' => 'Thanh toán khi nhận hàng'],
        ];

        foreach ($items as $item) {
            PaymentMethod::updateOrCreate($item);
        }
    }
}
