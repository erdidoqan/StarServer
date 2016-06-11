<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name');
            $table->integer('menu_id')->unsigned();;

            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade');

            $table->integer('category_id')->unsigned();;

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->float('price');
            $table->string('promotion_type')->nullable();
            $table->string('promotion')->nullable();
            $table->integer('count');
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
        Schema::drop('baskets');
    }
}
