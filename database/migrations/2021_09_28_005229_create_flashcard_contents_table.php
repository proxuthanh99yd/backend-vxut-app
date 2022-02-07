<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashcardContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashcard_contents', function (Blueprint $table) {
            $table->id();
            $table->text('front');
            $table->text('back');
            $table->timestamps();
        });
        if (Schema::hasTable('flashcard_titles')) {
            Schema::table('flashcard_contents', function (Blueprint $table) {
                $table->foreignId('flashcard_content_id')
                    ->constrained('flashcard_contents')
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
        Schema::dropIfExists('flashcard_contents');
    }
}
