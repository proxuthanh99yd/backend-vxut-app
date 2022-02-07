<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashcardContent extends Model
{
    //
    protected $fillable = ['front', 'back', 'flashcard_title_id'];
}
