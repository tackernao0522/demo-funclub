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
            $table->string('phone')->nullable();
            $table->enum('role', ['member', 'premium', 'admin'])->default('member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('product')->nullable();
            $table->string('slider')->nullable();
            $table->string('coupons')->nullable();
            $table->string('shipping')->nullable();
            $table->string('blog')->nullable();
            $table->string('setting')->nullable();
            $table->string('returnorder')->nullable();
            $table->string('review')->nullable();
            $table->string('orders')->nullable();
            $table->string('stock')->nullable();
            $table->string('reports')->nullable();
            $table->string('alluser')->nullable();
            $table->string('adminuserrole')->nullable();
            $table->integer('type')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            [
                'id' => 1, 'name' => 'Administrator',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'brand' => '1',
                'category' => '1',
                'product' => '1',
                'slider' => '1',
                'coupons' => '1',
                'shipping' => '1',
                'blog' => '1',
                'setting' => '1',
                'returnorder' => '1',
                'review' => '1',
                'orders' => '1',
                'stock' => '1',
                'reports' => '1',
                'alluser' => '1',
                'adminuserrole' => '1',
                'type' => '1',
                'password' => bcrypt('password'),
            ]
        );
        DB::table('users')->insert(['id' => 2, 'name' => 'Premium', 'email' => 'premium@example.com', 'password' => bcrypt('password'), 'role' => 'premium']);
        DB::table('users')->insert(['id' => 3, 'name' => 'User', 'email' => 'takaki55730317@gmail.com', 'password' => bcrypt('password')]);
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
