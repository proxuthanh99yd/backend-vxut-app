<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Tests extends Model
{
    protected $fillable = ['name', 'level_id', 'user_id'];

    public function contest()
    {
        return $this->belongsToMany(Contests::class, 'contest_test', 'test_id', 'contest_id')->withPivot('id');
    }
    public function level()
    {
        return $this->hasOne(Levels::class, 'id', 'level_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
