<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultSkills extends Model
{

    public function testSkill()
    {
        return $this->hasOne(TestSkills::class, 'id', 'test_skill_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
