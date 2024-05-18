<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\RoomHasImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomHasImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            $items = [
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017397/4_u9q2km.jpg'],
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017398/2_qld1de.png'],
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017397/6_mzyz6w.webp'],
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017397/5_x8wcvg.jpg'],
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017396/1_nblz57.jpg'],
                ['room_id' => "$i", 'url' => 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1716017396/3_gbogdd.jpg'],
            ];

            foreach ($items as $item) {
                RoomHasImage::updateOrCreate($item);
            }
        }
    }
}
