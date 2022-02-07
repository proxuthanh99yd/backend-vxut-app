<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contests extends Model
{
    public function test()
    {
        return $this->belongsToMany(Tests::class, 'contest_test', 'contest_id', 'test_id');
    }
}
