<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            RoleDatabaseSeeder::class,
            UserDatabaseSeeder::class,
            CouponSeeder::class,
            PaymentMethodSeeder::class,
            RoomSeeder::class,
            RoomHasImageSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
