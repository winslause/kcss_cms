<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'roles_permissions';
    protected $fillable = ['name', 'type', 'description'];
}