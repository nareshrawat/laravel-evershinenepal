<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKcategoryKitchenPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kcategory_kitchen', function (Blueprint $table) {
            $table->integer('kcategory_id')->unsigned()->index();
            $table->foreign('kcategory_id')->references('id')->on('kcategories')->onDelete('cascade');
            $table->integer('kitchen_id')->unsigned()->index();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->primary(['kcategory_id', 'kitchen_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kcategory_kitchen');
    }
}
