<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiemsTable extends Migration
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
            $table->bigInteger('shipping_fee_payer_id')->unsigned();
            $table->bigInteger('delivery_method_id')->unsigned();
            $table->bigInteger('delivery_time_id')->unsigned();
            $table->bigInteger('stock');
            $table->string('name');
            $table->string('item_image_name');
            $table->text('description');
            $table->integer('price')->unsigned();
            $table->string('state');
            $table->timestamp('bought_at')->nullable();

            $table->timestamps();

            $table->foreign('seller_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('secondary_ec_category_id')
                ->references('id')
                ->on('secondary_ec_categories')->onDelete('cascade');
            $table->foreign('item_condition_id')
                ->references('id')
                ->on('item_conditions')->onDelete('cascade');
            $table->foreign('shipping_fee_payer_id')
                ->references('id')
                ->on('shipping_fee_payers')->onDelete('cascade');
            $table->foreign('delivery_method_id')
                ->references('id')
                ->on('delivery_methods')->onDelete('cascade');
            $table->foreign('delivery_time_id')
                ->references('id')
                ->on('delivery_times')->onDelete('cascade');
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
