<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('email', 191)->nullable();
            $table->string('password')->nullable();
            $table->string('user_name');
            $table->string('social_type');
            $table->string('social_id');
            $table->rememberToken();

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
        Schema::drop('tr_users');
    }

}
