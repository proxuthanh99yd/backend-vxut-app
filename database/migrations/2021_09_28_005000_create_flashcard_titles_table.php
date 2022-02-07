<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashcardTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashcard_titles', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('public')->default(1);
            $table->timestamps();
        });
        if (Schema::hasTable('users')) {
            Schema::table('flashcard_titles', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->constrained('users')
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
        Schema::dropIfExists('flashcard_titles');
    }
}
