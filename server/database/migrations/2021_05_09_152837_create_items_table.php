<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->unsigned();
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->bigInteger('secondary_ec_category_id')->unsigned();
            $table->bigInteger('item_condition_id')->unsigned();
            $table->string('name');
            $table->string('item_image_name');
            $table->text('description');
            $table->integer('price')->unsigned();
            $table->string('state');

            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('secondary_ec_category_id')
                ->references('id')
                ->on('secondary_ec_categories')->onDelete('cascade');
            $table->foreign('item_condition_id')->references('id')
                ->on('item_conditions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
