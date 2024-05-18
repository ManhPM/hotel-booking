<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Super Admin', 'group' => 'system'],
            ['name' => 'admin', 'display_name' => 'Admin', 'group' => 'system'],

            ['name' => 'employee', 'display_name' => 'employee', 'group' => 'system'],

            ['name' => 'manager', 'display_name' => 'manager', 'group' => 'system'],

            ['name' => 'user', 'display_name' => 'user', 'group' => 'system'],

        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }

        $permissions = [
            ['name' => 'create-user', 'display_name' => 'Create user', 'group' => 'user'],
            ['name' => 'update-user', 'display_name' => 'Update user', 'group' => 'user'],
            ['name' => 'show-user', 'display_name' => 'Show user', 'group' => 'user'],
            ['name' => 'delete-user', 'display_name' => 'Delete user', 'group' => 'user'],

            ['name' => 'create-role', 'display_name' => 'Create role', 'group' => 'role'],
            ['name' => 'update-role', 'display_name' => 'Update role', 'group' => 'role'],
            ['name' => 'show-role', 'display_name' => 'Show role', 'group' => 'role'],
            ['name' => 'delete-role', 'display_name' => 'Delete role', 'group' => 'role'],

            ['name' => 'create-category', 'display_name' => 'Create category', 'group' => 'category'],
            ['name' => 'update-category', 'display_name' => 'Update category', 'group' => 'category'],
            ['name' => 'show-category', 'display_name' => 'Show category', 'group' => 'category'],
            ['name' => 'delete-category', 'display_name' => 'Delete category', 'group' => 'category'],

            ['name' => 'create-room', 'display_name' => 'Create room', 'group' => 'room'],
            ['name' => 'update-room', 'display_name' => 'Update room', 'group' => 'room'],
            ['name' => 'show-room', 'display_name' => 'Show room', 'group' => 'room'],
            ['name' => 'delete-room', 'display_name' => 'Delete room', 'group' => 'room'],

            ['name' => 'create-coupon', 'display_name' => 'Create coupon', 'group' => 'coupon'],
            ['name' => 'update-coupon', 'display_name' => 'Update coupon', 'group' => 'coupon'],
            ['name' => 'show-coupon', 'display_name' => 'Show coupon', 'group' => 'coupon'],
            ['name' => 'delete-coupon', 'display_name' => 'Delete coupon', 'group' => 'coupon'],

            ['name' => 'cancel-order', 'display_name' => 'Cancel order', 'group' => 'orders'],
            ['name' => 'confirm-order', 'display_name' => 'Confirm order', 'group' => 'orders'],
            ['name' => 'show-order', 'display_name' => 'Show order', 'group' => 'orders'],
            ['name' => 'show-order-detail', 'display_name' => 'Show order detail', 'group' => 'orders'],
        ];

        foreach ($permissions as $item) {
            Permission::updateOrCreate($item);
        }

        $role_has_permissions = [
            ['permission_id' => '1', 'role_id' => '1'],
            ['permission_id' => '2', 'role_id' => '1'],
            ['permission_id' => '3', 'role_id' => '1'],
            ['permission_id' => '4', 'role_id' => '1'],
            ['permission_id' => '5', 'role_id' => '1'],
            ['permission_id' => '6', 'role_id' => '1'],
            ['permission_id' => '7', 'role_id' => '1'],
            ['permission_id' => '8', 'role_id' => '1'],
            ['permission_id' => '9', 'role_id' => '1'],
            ['permission_id' => '10', 'role_id' => '1'],
            ['permission_id' => '11', 'role_id' => '1'],
            ['permission_id' => '12', 'role_id' => '1'],
            ['permission_id' => '13', 'role_id' => '1'],
            ['permission_id' => '14', 'role_id' => '1'],
            ['permission_id' => '15', 'role_id' => '1'],
            ['permission_id' => '16', 'role_id' => '1'],
            ['permission_id' => '17', 'role_id' => '1'],
            ['permission_id' => '18', 'role_id' => '1'],
            ['permission_id' => '19', 'role_id' => '1'],
            ['permission_id' => '20', 'role_id' => '1'],
            ['permission_id' => '21', 'role_id' => '1'],
            ['permission_id' => '22', 'role_id' => '1'],
            ['permission_id' => '23', 'role_id' => '1'],
            ['permission_id' => '24', 'role_id' => '1'],
            ['permission_id' => '1', 'role_id' => '5'],
            ['permission_id' => '2', 'role_id' => '5'],
            ['permission_id' => '3', 'role_id' => '5'],
            ['permission_id' => '4', 'role_id' => '5'],
            ['permission_id' => '5', 'role_id' => '5'],
            ['permission_id' => '6', 'role_id' => '5'],
            ['permission_id' => '7', 'role_id' => '5'],
            ['permission_id' => '8', 'role_id' => '5'],
            ['permission_id' => '9', 'role_id' => '5'],
            ['permission_id' => '10', 'role_id' => '5'],
            ['permission_id' => '11', 'role_id' => '5'],
            ['permission_id' => '12', 'role_id' => '5'],
            ['permission_id' => '13', 'role_id' => '5'],
            ['permission_id' => '14', 'role_id' => '5'],
            ['permission_id' => '15', 'role_id' => '5'],
            ['permission_id' => '16', 'role_id' => '5'],
            ['permission_id' => '17', 'role_id' => '5'],
            ['permission_id' => '18', 'role_id' => '5'],
            ['permission_id' => '19', 'role_id' => '5'],
            ['permission_id' => '20', 'role_id' => '5'],
            ['permission_id' => '21', 'role_id' => '5'],
            ['permission_id' => '22', 'role_id' => '5'],
            ['permission_id' => '23', 'role_id' => '5'],
            ['permission_id' => '24', 'role_id' => '5'],
        ];

        foreach ($role_has_permissions as $item) {
            RoleHasPermission::updateOrCreate($item);
        }
    }
}
