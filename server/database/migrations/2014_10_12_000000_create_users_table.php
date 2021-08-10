<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('role', ['member', 'premium', 'admin'])->default('member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(['id' => 1, 'name' => 'Administrator', 'email' => 'admin@example.com', 'phone' => '090-1111-1234', 'password' => bcrypt('password'), 'role' => 'admin']);
        DB::table('users')->insert(['id' => 2, 'name' => 'Premium', 'email' => 'premium@example.com', 'phone' => '090-2222-2345', 'password' => bcrypt('password'), 'role' => 'premium']);
        DB::table('users')->insert(['id' => 3, 'name' => 'User', 'email' => 'takaki55730317@gmail.com', 'phone' => '090-3333-3456', 'password' => bcrypt('password')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
