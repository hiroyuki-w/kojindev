<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTrApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_applications', function (Blueprint $table) {
            $table->foreign('tr_user_id',
                'fk_tr_applications_tr_users1')->references('id')->on('tr_users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_applications', function (Blueprint $table) {
            $table->dropForeign('fk_tr_applications_tr_users1');
        });
    }

}
