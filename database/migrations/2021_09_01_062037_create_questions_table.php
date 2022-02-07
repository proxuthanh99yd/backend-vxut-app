<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->binary('photo')->nullable();
            $table->longText('audio')->nullable();
            $table->text('question');
            $table->timestamps();
        });
        if (Schema::hasTable('chapters')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->foreignId('chapter_id')
                    ->constrained('chapters')
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
        Schema::dropIfExists('questions');
    }
}
