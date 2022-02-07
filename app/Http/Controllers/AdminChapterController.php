<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChapterController extends Controller
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
        //
    }

    public function storeChapter(ChapterStoreRequest $request, $id)
    {
        $contest_test_id = DB::table('contest_test')->where('test_id', $id)->where('contest_id', $request->contest_id)->first();
        $chapter = new Chapters();
        $chapter->name = $request->name;
        $chapter->contest_test_id = $contest_test_id->id;
        $chapter->save();
        return response()->json($chapter);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contest_id = Tests::with('contest')->where('id', $id)->get();
        foreach ($contest_id as $contest) {
            foreach ($contest->contest as $pivot) {
                $pivotTb[] = $pivot->pivot->id;
            }
        }
        $chapter = DB::table('contest_test')
            ->join('chapters', 'contest_test.id', '=', 'chapters.contest_test_id')
            ->whereIn('contest_test.id', $pivotTb)
            ->orderBy('contest_test_id')
            ->get();

        return response()->json($chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterUpdateRequest $request, $id)
    {
        $chapter = Chapters::findOrFail($id);
        $chapter->name = $request->name;
        $chapter->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapters::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
