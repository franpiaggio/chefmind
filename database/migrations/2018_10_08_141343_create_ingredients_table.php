<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('ingredient_recipe', function(Blueprint $table){
            $table->integer('ingredient_id')->unsigned()->index();
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            $table->string('quantity')->default('-');
            $table->integer('recipe_id')->unsigned()->index();
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
        Schema::dropIfExists('ingredients');
    }
}
