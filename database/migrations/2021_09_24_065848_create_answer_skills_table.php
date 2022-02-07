<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_skills', function (Blueprint $table) {
            $table->id();
            $table->text('sub_question')->nullable();
            $table->text('answer_1');
            $table->text('answer_2');
            $table->text('answer_3');
            $table->text('answer_4');
            $table->text('answer');
            $table->integer('point');
            $table->timestamps();
        });
        if (Schema::hasTable('question_skills')) {
            Schema::table('answer_skills', function (Blueprint $table) {
                $table->foreignId('question_skill_id')
                    ->constrained('question_skills')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_skills');
    }
}
