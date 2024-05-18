<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'ROOM101', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1000000', 'max_guests' => 3, 'category_id' => '1'],
            ['name' => 'ROOM102', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1000000', 'max_guests' => 3, 'category_id' => '1'],
            ['name' => 'ROOM103', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1000000', 'max_guests' => 3, 'category_id' => '1'],
            ['name' => 'ROOM104', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1000000', 'max_guests' => 3, 'category_id' => '1'],
            ['name' => 'ROOM105', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1000000', 'max_guests' => 3, 'category_id' => '1'],
            ['name' => 'ROOM201', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1200000', 'max_guests' => 3, 'category_id' => '2'],
            ['name' => 'ROOM202', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1200000', 'max_guests' => 3, 'category_id' => '2'],
            ['name' => 'ROOM203', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1200000', 'max_guests' => 3, 'category_id' => '2'],
            ['name' => 'ROOM204', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1200000', 'max_guests' => 3, 'category_id' => '2'],
            ['name' => 'ROOM205', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1200000', 'max_guests' => 3, 'category_id' => '2'],
            ['name' => 'ROOM301', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1500000', 'max_guests' => 3, 'category_id' => '3'],
            ['name' => 'ROOM302', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1500000', 'max_guests' => 3, 'category_id' => '3'],
            ['name' => 'ROOM303', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1500000', 'max_guests' => 3, 'category_id' => '3'],
            ['name' => 'ROOM304', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1500000', 'max_guests' => 3, 'category_id' => '3'],
            ['name' => 'ROOM305', 'description' => 'Phòng khách sạn này được thiết kế rộng rãi và thoải mái, với cảnh quan đẹp và không gian tiện nghi. Giường êm ái, phòng tắm hiện đại và tầm nhìn hướng ra thành phố tạo nên trải nghiệm thoải mái cho khách hàng.', 'price' => '1500000', 'max_guests' => 3, 'category_id' => '3'],
        ];

        foreach ($items as $item) {
            Room::updateOrCreate($item);
        }
    }
}
