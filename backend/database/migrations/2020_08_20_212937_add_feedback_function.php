<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFeedbackFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tr_feedbacks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tr_application_id')->index('fk_tr_feedback_tr_applications1_idx');
            $table->string('feedback_title');
            $table->string('question_1');
            $table->string('question_2');
            $table->string('question_3');
            $table->timestamps();

            $table->foreign('tr_application_id', 'fk_tr_feedback_tr_applications1_idx')
                ->references('id')->on('tr_applications')
                ->onDelete('CASCADE')
                ->onUpdate('no action');
        });


        Schema::create('tr_feedback_comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('comment_tr_user_id')->index('fk_tr_feedback_comment_tr_users1_idx');
            $table->integer('tr_feedback_id')->index('fk_tr_feedback_comment_tr_feedbacks1_idx');
            $table->string('feedback_comment');
            $table->timestamps();

            $table->foreign('tr_feedback_id', 'fk_tr_feedback_comment_tr_feedbacks1_idx')
                ->references('id')->on('tr_feedbacks')
                ->onDelete('CASCADE')
                ->onUpdate('no action');

            $table->foreign('comment_tr_user_id', 'fk_tr_feedback_comment_tr_users1_idx')
                ->references('id')->on('tr_users')
                ->onDelete('CASCADE')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_feedback_comments');
        Schema::dropIfExists('tr_feedbacks');
    }
}
