<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrApplicationTagsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_application_tags', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tr_application_id')->index('fk_tr_application_tags_tr_applications1_idx');
            $table->string('tag_name');
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
        Schema::drop('tr_application_tags');
    }

}
