<?php

namespace App\Http\Controllers;

use App\AnswerSkills;
use App\QuestionSkills;
use Illuminate\Http\Request;

class AdminAnswerSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answerSkill = new AnswerSkills();
        $answerSkill->fill($request->all());
        $answerSkill->save();
        return response()->json($answerSkill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = QuestionSkills::find($id);
        $answers = AnswerSkills::where('question_skill_id', $id)->get();
        return response()->json(['answer' => $answers, 'question' => $question]);
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
        $answerSkill = AnswerSkills::find($id);
        $answerSkill->sub_question = $request->sub_question;
        $answerSkill->answer_1 = $request->answer_1;
        $answerSkill->answer_2 = $request->answer_2;
        $answerSkill->answer_3 = $request->answer_3;
        $answerSkill->answer_4 = $request->answer_4;
        $answerSkill->answer = $request->answer;
        $answerSkill->point = $request->point;
        $answerSkill->save();
        return response()->json($answerSkill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AnswerSkills::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
