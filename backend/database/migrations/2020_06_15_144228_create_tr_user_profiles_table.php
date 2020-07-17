<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrUserProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_user_profiles', function (Blueprint $table) {
            $table->integer('tr_user_id')->primary();
            $table->string('user_profile', 2000);
            $table->string('user_skillset', 2000);
            $table->string('git_account');
            $table->string('twitter_account');
            $table->string('my_url');
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
        Schema::drop('tr_user_profiles');
    }

}
