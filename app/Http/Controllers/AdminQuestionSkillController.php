<?php

namespace App\Http\Controllers;

use App\QuestionSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuestionSkillController extends Controller
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
        $questionSkill = new QuestionSkills();
        $questionSkill->question = $request->question;
        $questionSkill->test_skill_id = $request->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imgName = time() . '.' . $extention;
            $image->move(public_path('images'), $imgName);
            $questionSkill->photo = $imgName;
        }
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $extention = $audio->getClientOriginalExtension();
            $audioName = time() . '.' . $extention;
            $audio->move(public_path('audio'), $audioName);
            $questionSkill->audio = $audioName;
        }
        $questionSkill->save();
        return response()->json($questionSkill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questionSkill = QuestionSkills::where('test_skill_id', $id)->get();
        return response()->json($questionSkill);
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
    public function updateQuestionSkill(Request $request, $id)
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
        $question = QuestionSkills::find($id);
        $question->question = $request->question;

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
        return response()->json(QuestionSkills::where('id', $id)->get());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuestionSkills::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
