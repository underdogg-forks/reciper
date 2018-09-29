<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('visitor_id');
            $table->string('name', config('validation.settings_name_max'));
            $table->string('about_me', config('validation.settings_about_me'))->nullable();
            $table->string('email')->unique();
            $table->decimal('exp', 8, 1)->default(0);
            $table->timestamp('notif_check')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('contact_check')->nullable();
            $table->string('image')->default('default.jpg');
            $table->string('password', 250);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
