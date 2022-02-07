<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Answers extends Model
{

    protected $fillable = ['sub_question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'answer', 'point', 'question_id'];
    // protected $hidden = [
    //     'answer'
    // ];
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    public function student_answer()
    {
        return $this->hasOne(StudentAnswer::class, 'answer_id', 'id');
    }
}
