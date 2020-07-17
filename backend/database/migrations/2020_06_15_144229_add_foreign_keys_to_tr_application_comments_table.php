<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTrApplicationCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_application_comments', function (Blueprint $table) {
            $table->foreign('tr_application_id',
                'fk_tr_application_comments_tr_applications1')->references('id')->on('tr_applications')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('tr_user_id',
                'fk_tr_application_comments_tr_users1')->references('id')->on('tr_users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_application_comments', function (Blueprint $table) {
            $table->dropForeign('fk_tr_application_comments_tr_applications1');
            $table->dropForeign('fk_tr_application_comments_tr_users1');
        });
    }

}
