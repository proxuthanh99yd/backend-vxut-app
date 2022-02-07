<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswerSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answer_skills', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->timestamps();
        });
        if (Schema::hasTable('users')) {
            Schema::table('student_answer_skills', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreignId('answer_skill_id')
                    ->constrained('answer_skills')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreignId('result_skill_id')
                    ->constrained('result_skills')
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
        Schema::dropIfExists('student_answer_skills');
    }
}
