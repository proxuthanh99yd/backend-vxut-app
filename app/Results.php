<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    public function test()
    {
        return $this->hasOne(Tests::class, 'id', 'test_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
