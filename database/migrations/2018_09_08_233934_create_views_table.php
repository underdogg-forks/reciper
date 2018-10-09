<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('visits')->default(0);

            $table->unsignedInteger('visitor_id');
            $table->foreign('visitor_id')->references('id')->on('visitors');

            $table->unsignedInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views');
    }
}
