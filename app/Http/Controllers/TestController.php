<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Chapters;
use App\Levels;
use App\Results;
use App\StudentAnswer;
use App\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Levels::with(array('test' => function ($query) {
            $query->where('active', '=', 1);
        }))->where('id', '>', 1)->get());
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
            $point[] = Answers::where('id', $key)->where('answer', $request->$key)->sum('point');
            if ($key != "test_id" && $key != "contest_id") {
                $student_answer = new StudentAnswer();
                $student_answer->answer = $request->$key;
                $student_answer->answer_id = $key;
                $student_answer->user_id = Auth::id();
                $student_answer->save();
            }
        }
        $point = array_sum($point);
        if ($point) {
            $result = Results::where('user_id', Auth::id())->where('test_id', $request->test_id)->first();
            if ($result) {
                if ($request->contest_id == 1) {
                    if (!$result->vocabularyPoint) {
                        $result->vocabularyPoint = $point;
                        $result->save();
                        return response()->json($result);
                    }
                }
                if ($request->contest_id == 2) {
                    if (!$result->grammarPoint) {
                        $result->grammarPoint = $point;
                        $result->save();
                        return response()->json($result);
                    }
                }
                if ($request->contest_id == 3) {
                    if (!$result->listenPoint) {
                        $result->listenPoint = $point;
                        $result->save();
                        return response()->json($result);
                    }
                }
                if ($request->contest_id == 4) {
                    if (!$result->vocabularyPoint) {
                        $result->vocabularyPoint = $point;
                        $result->save();
                        return response()->json($result);
                    }
                }
            } else {
                $result = new Results();
                $result->vocabularyPoint = $point;
                $result->user_id = Auth::id();
                $result->test_id = $request->test_id;
                $result->save();
                return response()->json($result);
            }
        } else {
            $result = "";
        }

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Tests::find($id));
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

    public function getChapter($test_id, $contest_id)
    {
        $contest_test = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', $contest_id)->first();
        $chapter = Chapters::with('question.answer')->where('contest_test_id', $contest_test->id)->get();
        return response()->json($chapter);
    }
    public function getResult($id)
    {
        return response()->json(Results::where('user_id', Auth::id())->where('test_id', $id)->first());
    }
    public function result_detail($test_id)
    {
        $test = Tests::where('id', $test_id)->first();
        if ($test->level_id < 5) {
            $contest_test1 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 1)->first();
            $chapter1 = Chapters::with(
                array('question.answer.student_answer' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                })
            )
                ->where('contest_test_id', $contest_test1->id)->get();
            $contest_test2 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 2)->first();
            $chapter2 = Chapters::with(
                array('question.answer.student_answer' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                })
            )
                ->where('contest_test_id', $contest_test2->id)->get();
            $contest_test3 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 3)->first();
            $chapter3 = Chapters::with(
                array('question.answer.student_answer' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                })
            )
                ->where('contest_test_id', $contest_test3->id)->get();
            return response()->json(["chapter_1" => $chapter1, "chapter_2" => $chapter2, "chapter_3" => $chapter3]);
        } else {
            $contest_test4 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 4)->first();
            $chapter4 = Chapters::with(
                array('question.answer.student_answer' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                })
            )
                ->where('contest_test_id', $contest_test4->id)->get();
            $contest_test3 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 3)->first();
            $chapter3 = Chapters::with(
                array('question.answer.student_answer' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                })
            )
                ->where('contest_test_id', $contest_test3->id)->get();
            return response()->json(["chapter_4" => $chapter4, "chapter_3" => $chapter3]);
        }
    }
    public function testLevel($id)
    {
        return response()->json(Tests::find($id));
    }
}
