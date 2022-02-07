<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFlashcardContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flashcard_contents', function (Blueprint $table) {
            $table->dropForeign(['flashcard_content_id']);
            $table->dropColumn('flashcard_content_id');
        });
        if (Schema::hasTable('flashcard_titles')) {
            Schema::table('flashcard_contents', function (Blueprint $table) {
                $table->foreignId('flashcard_title_id')
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
        //
    }
}
