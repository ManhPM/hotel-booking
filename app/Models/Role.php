<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Traits\HasPermissions;

class Role extends ModelsRole
{
    use HasFactory, HasPermissions;
    protected $filable = [
        'name',
        'display_name',
        'group',
        'guard_name'
    ];
}
