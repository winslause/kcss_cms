<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'roles_permissions';
    protected $fillable = ['name', 'type', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role_permission', 'role_permission_id', 'user_id');
    }
}