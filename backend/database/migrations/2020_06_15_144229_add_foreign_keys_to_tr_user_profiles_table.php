<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTrUserProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_user_profiles', function (Blueprint $table) {
            $table->foreign('tr_user_id',
                'fk_tr_user_profiles_tr_users')->references('id')->on('tr_users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_user_profiles', function (Blueprint $table) {
            $table->dropForeign('fk_tr_user_profiles_tr_users');
        });
    }

}
