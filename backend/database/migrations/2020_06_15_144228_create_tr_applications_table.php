<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_applications', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tr_user_id')->index('fk_tr_applications_tr_users1_idx');
            $table->string('application_name');
            $table->string('application_concept');
            $table->string('application_overview');
            $table->boolean('public_flg')->default("1");
            $table->boolean('application_type');
            $table->string('used_technology');
            $table->string('pr_message');
            $table->string('additional_features');
            $table->string('other_message');
            $table->string('application_url');
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
        Schema::drop('tr_applications');
    }

}
