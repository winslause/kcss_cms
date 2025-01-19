<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesToUsersTable extends Migration  // Unique class name
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new fields here
            $table->string('profile_photo_path')->nullable()->after('remember_token');
            $table->string('phone')->nullable()->after('profile_photo_path');
            $table->boolean('is_active')->default(true)->after('phone');
            $table->string('roles')->default('user')->after('is_active');  // Adding the 'roles' column
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns added in the up() method
            $table->dropColumn(['profile_photo_path', 'phone', 'is_active', 'roles']); // Including the 'roles' column
        });
    }
}
