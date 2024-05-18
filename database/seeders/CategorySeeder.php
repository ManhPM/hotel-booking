<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Standard'],
            ['name' => 'Deluxe'],
            ['name' => 'Suite'],
        ];

        foreach ($items as $item) {
            Category::updateOrCreate($item);
        }
    }
}
