<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrApplicationCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_application_comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tr_application_id')->index('fk_tr_application_comments_tr_applications1_idx');
            $table->integer('tr_user_id')->index('fk_tr_application_comments_tr_users1_idx');
            $table->string('user_name');
            $table->string('post_comment', 2000);
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
        Schema::drop('tr_application_comments');
    }

}
