<?php

namespace App\Http\Controllers;

use App\TestSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTestSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TestSkills::with('level', 'user', 'skill')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testSkill = new TestSkills();
        $testSkill->fill($request->all());
        $testSkill->active = $request->public;
        $testSkill->user_id = Auth::id();
        $testSkill->save();
        return response()->json($testSkill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $testSkill = TestSkills::find($id);
        $testSkill->name = $request->name;
        $testSkill->active = $request->public;
        $testSkill->skill_id = $request->skill_id;
        $testSkill->level_id = $request->level_id;
        $testSkill->save();
        return response()->json($testSkill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TestSkills::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
