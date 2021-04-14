<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('sort_no')->unsigned();
            $table->timestamps();
        });
        $primaryCategory_seeds = [
            [
                'id' => 1,
                'name' => 'カテゴリー1',
                'sort_no' => 1,
            ],
            [
                'id'      => 2,
                'name'    => 'カテゴリー2',
                'sort_no' => 2,
            ],
            [
                'id'      => 3,
                'name'    => 'カテゴリー3',
                'sort_no' => 3,
            ],
            [
                'id'      => 4,
                'name'    => 'その他',
                'sort_no' => 4,
            ],
        ];
        foreach ($primaryCategory_seeds as $primaryCategory) {
            DB::table('primary_categories')->insert($primaryCategory);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('primary_categories');
    }
}
