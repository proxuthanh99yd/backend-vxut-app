<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $fillable = ['question', 'photo', 'audio'];

    public function answer()
    {
        return $this->hasMany(Answers::class, 'question_id', 'id');
    }
}
