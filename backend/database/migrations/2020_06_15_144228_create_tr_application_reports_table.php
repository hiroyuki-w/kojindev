<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrApplicationReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_application_reports', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tr_application_id')->index('fk_tr_application_reports_tr_applications1_idx');
            $table->boolean('report_type');
            $table->string('report_title');
            $table->string('report_text', 2000);
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
        Schema::drop('tr_application_reports');
    }

}
