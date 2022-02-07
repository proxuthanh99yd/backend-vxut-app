<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerSkills extends Model
{
    protected $fillable = ['sub_question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'answer', 'point', 'question_skill_id'];
    // protected $hidden = [
    //     'answer'
    // ];
    public function student_answer_skill()
    {
        return $this->hasMany(
            StudentAnswerSkill::class,
            'answer_skill_id',
            'id'
        );
    }
}
