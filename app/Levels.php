<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    public function test()
    {
        return $this->hasMany(Tests::class, 'level_id', 'id');
    }
}
