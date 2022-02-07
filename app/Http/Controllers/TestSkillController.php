<?php

namespace App\Http\Controllers;

use App\AnswerSkills;
use App\Results;
use App\ResultSkills;
use App\StudentAnswerSkill;
use App\TestSkills;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = "";
        foreach ($request->except('_token') as $key => $part) {
            $point[] = AnswerSkills::where('id', $key)->where('answer', $request->$key)->sum('point');
        }
        $point = array_sum($point);

        $result = new ResultSkills();
        $result->SkillPoint = $point;
        $result->user_id = Auth::id();
        $result->test_skill_id = $request->test_skill_id;
        $result->save();
        $result_id = $result->id;
        foreach ($request->except('_token') as $key => $part) {
            if ($key != "test_skill_id" && $key != "contest_id") {
                $student_answer_skill = new StudentAnswerSkill();
                $student_answer_skill->answer = $request->$key;
                $student_answer_skill->answer_skill_id = $key;
                $student_answer_skill->result_skill_id = $result_id;
                $student_answer_skill->user_id = Auth::id();
                $student_answer_skill->save();
            }
        }
        $result_rs = ResultSkills::with('testSkill', 'user')->where('id', $result_id)->get();
        return response()->json($result_rs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TestSkills::with('questionSkill.answerSkill')->where('id', $id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showTest($level_id, $skill_id)
    {
        return response()->json(TestSkills::with('user', 'level', 'skill')->where('level_id', $level_id)->where('skill_id', $skill_id)->where('active', 1)->get());
    }
}
