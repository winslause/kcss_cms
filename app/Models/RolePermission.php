<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['name', 'type', 'description'];

    // Optional, if you need to specify the table name explicitly
    protected $table = 'roles_permissions';
}
