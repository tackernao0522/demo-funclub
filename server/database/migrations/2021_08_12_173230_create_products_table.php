<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subCategory_id')->unsigned();
            $table->bigInteger('subSubCategory_id')->unsigned();
            $table->string('product_name');
            $table->string('product_slug_name');
            $table->string('product_code');
            $table->integer('product_qty');
            $table->string('product_tags_name');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->integer('selling_price');
            $table->integer('discount_price')->nullable();
            $table->string('short_descp');
            $table->text('long_descp');
            $table->string('product_thambnail');
            $table->bigInteger('hot_deals')->nullable()->unsigned();
            $table->bigInteger('featured')->nullable()->unsigned();
            $table->bigInteger('spacial_offer')->nullable()->unsigned();
            $table->bigInteger('special_deals')->nullable()->unsigned();
            $table->string('digital_file')->nullable();
            $table->bigInteger('status')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('subCategory_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
            $table->foreign('subSubCategory_id')
                ->references('id')
                ->on('sub_sub_categories')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
