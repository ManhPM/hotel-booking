<?php

namespace Database\Seeders;

use App\Models\CartProduct;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run()
    {
        $users = [
            ['name' => 'Phạm Minh Mạnh', 'email' => 'phammanhbeo2001@gmail.com', 'phone' => '0961592551', 'address' => 'Địa chỉ', 'email_verified_at' => '2024-05-12 08:00:42', 'password' => '$2a$10$pVN6f.l9WXqsQxifG89kTOewLKmN6BxXjFoqIUra5MIBcc6Z8yhtW', 'remember_token' => 'null'],
        ];
        $admin = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'phone' => '0123456789', 'address' => 'Địa chỉ', 'email_verified_at' => '2024-05-12 08:00:42', 'password' => '$2a$10$pVN6f.l9WXqsQxifG89kTOewLKmN6BxXjFoqIUra5MIBcc6Z8yhtW', 'remember_token' => 'null'],
        ];

        foreach ($users as $item) {
            $item['image'] = 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1692954334/anhdaidien_onsafn.jpg';
            $user = $this->user->create($item);
            $user->roles()->attach(['5']);
        }
        foreach ($admin as $item) {
            $item['image'] = 'https://res.cloudinary.com/dpgjnngzt/image/upload/v1692954334/anhdaidien_onsafn.jpg';
            $user = $this->user->create($item);
            $user->roles()->attach(['1']);
        }
    }
}
