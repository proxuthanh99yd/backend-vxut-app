<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashcardTitle extends Model
{
    //
    protected $fillable = ['', 'name', 'public'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
