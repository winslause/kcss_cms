<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('role_user')) {  // Check if the table already exists
            Schema::create('role_user', function (Blueprint $table) {
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->primary(['role_id', 'user_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
