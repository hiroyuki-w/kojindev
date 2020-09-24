<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTrApplicationsVarcharLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_applications', function (Blueprint $table) {
            //データ型の変更
            $table->string('application_overview', 2000)->change();
            $table->string('used_technology', 2000)->change();
            $table->string('pr_message', 2000)->change();
            $table->string('additional_features', 2000)->change();
            $table->string('other_message', 2000)->change();
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
            //データ型の変更
            $table->string('application_overview', 255)->change();
            $table->string('used_technology', 255)->change();
            $table->string('pr_message', 255)->change();
            $table->string('additional_features', 255)->change();
            $table->string('other_message', 255)->change();
        });
    }
}
