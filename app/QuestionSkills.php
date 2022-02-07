<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSkills extends Model
{
    public function answerSkill()
    {
        return $this->hasMany(AnswerSkills::class, 'question_skill_id', 'id');
    }
}
