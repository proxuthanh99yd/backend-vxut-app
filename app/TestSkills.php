<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSkills extends Model
{

    protected $fillable = ['name', 'level_id', 'skill_id'];


    public function level()
    {
        return $this->hasOne(Levels::class, 'id', 'level_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function skill()
    {
        return $this->hasOne(Skills::class, 'id', 'skill_id');
    }
    public function questionSkill()
    {
        return $this->hasMany(QuestionSkills::class, 'test_skill_id', 'id');
    }
}
