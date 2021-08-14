<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_districts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('division_id')->unsigned();
            $table->string('district_name');
            $table->integer('sort_no')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('division_id')
                ->references('id')
                ->on('ship_divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_districts');
    }
}
