<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('SkillPoint')->nullable();
            $table->timestamps();
        });
        if (Schema::hasTable('users')) {
            Schema::table('result_skills', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('result_skills');
    }
}
