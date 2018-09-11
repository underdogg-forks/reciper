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
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('admin')->default(0);
            $table->boolean('master')->default(0);
            $table->float('points')->unsigned()->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('notif_check')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('contact_check')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('image')->default('default.jpg');
            $table->dateTime('online_at')->default(date("Y-m-d H:i:s"));
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
