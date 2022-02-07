<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    public function contest()
    {
        return $this->belongsToMany(Contests::class);
    }
    public function question()
    {
        return $this->hasMany(Questions::class, 'chapter_id', 'id');
    }
}
