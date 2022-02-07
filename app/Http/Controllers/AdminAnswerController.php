<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Http\Requests\AnswerStoreRequest;
use App\Questions;
use Illuminate\Http\Request;

class AdminAnswerController extends Controller
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
        $answers = new Answers();
        $answers->fill($request->all());
        $answers->save();
        return response()->json($answers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Questions::find($id);
        $answers = Answers::where('question_id', $id)->get();
        return response()->json(['answer' => $answers, 'question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerStoreRequest $request, $id)
    {
        $answers = Answers::find($id);
        $answers->sub_question = $request->sub_question;
        $answers->answer_1 = $request->answer_1;
        $answers->answer_2 = $request->answer_2;
        $answers->answer_3 = $request->answer_3;
        $answers->answer_4 = $request->answer_4;
        $answers->answer = $request->answer;
        $answers->point = $request->point;
        $answers->save();
        return response()->json($answers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answers::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
