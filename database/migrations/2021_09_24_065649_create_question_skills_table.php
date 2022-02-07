<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_skills', function (Blueprint $table) {
            $table->id();
            $table->binary('photo')->nullable();
            $table->longText('audio')->nullable();
            $table->text('question');
            $table->timestamps();
        });
        if (Schema::hasTable('test_skills')) {
            Schema::table('question_skills', function (Blueprint $table) {
                $table->foreignId('test_skill_id')
                    ->constrained('test_skills')
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
        Schema::dropIfExists('question_skills');
    }
}
