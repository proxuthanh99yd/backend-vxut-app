<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;

class AdminQuestionController extends Controller
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
    public function store(QuestionStoreRequest $request)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png|max:50000'
            ]);
        }
        if ($request->hasFile('audio')) {
            $request->validate([
                'audio' => 'required|mimes:mp3,wav,aac,m4a|max:50000'
            ]);
        }
        $question = new Questions();
        $question->question = $request->question;
        $question->chapter_id = $request->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imgName = time() . '.' . $extention;
            $image->move(public_path('images'), $imgName);
            $question->photo = $imgName;
        }
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $extention = $audio->getClientOriginalExtension();
            $audioName = time() . '.' . $extention;
            $audio->move(public_path('audio'), $audioName);
            $question->audio = $audioName;
        }
        $question->save();
        return response()->json($question);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Questions::where('chapter_id', $id)->orderBy('id', 'desc')->get();
        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionStoreRequest $request, $id)
    {
    }
    public function updateQuestion(QuestionStoreRequest $request, $id)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png|max:50000'
            ]);
        }
        if ($request->hasFile('audio')) {
            $request->validate([
                'audio' => 'required|mimes:mp3,wav,aac,m4a|max:50000'
            ]);
        }
        $question = Questions::find($id);
        $question->question = $request->question;
        $question->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imgName = time() . '.' . $extention;
            $image->move(public_path('images'), $imgName);
            DB::table('questions')
                ->where('id', $id)
                ->update(['photo' => $imgName]);
        }
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $extention = $audio->getClientOriginalExtension();
            $audioName = time() . '.' . $extention;
            $audio->move(public_path('audio'), $audioName);
            DB::table('questions')
                ->where('id', $id)
                ->update(['audio' => $audioName]);
        }
        return response()->json(Questions::with('answer')->where('id', $id)->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Questions::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
