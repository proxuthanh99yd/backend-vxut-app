<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\QuestionSkills;
use App\Results;
use App\ResultSkills;
use App\Tests;
use App\TestSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function testSkillHistory()
    {
        return response()->json(ResultSkills::with('testSkill')->where('user_id', Auth::id())->get());
    }
    public function testHistory()
    {
        return response()->json(Results::with('test')->where('user_id', Auth::id())->get());
    }
    public function result_skill_detail($test_skill_id, $result_skill_id)
    {
        $test_skill = QuestionSkills::with(
            array('answerSkill.student_answer_skill' => function ($query) use ($result_skill_id) {
                $query->where('user_id', '=', Auth::id());
                $query->where('result_skill_id', '=', $result_skill_id);
            })
        )
            ->where('test_skill_id', $test_skill_id)->get();
        return response()->json($test_skill);
    }
    public function getAllResultTest($test_id)
    {
        return response()->json(Results::with('user')->where("test_id", $test_id)->get());
    }

    public function result_test_detail($test_id, $user_id)
    {
        $test = Tests::where('id', $test_id)->first();
        if ($test->level_id < 5) {
            $contest_test1 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 1)->first();
            $chapter1 = Chapters::with(
                array('question.answer.student_answer' => function ($query) use ($user_id) {
                    $query->where('user_id', '=', $user_id);
                })
            )
                ->where('contest_test_id', $contest_test1->id)->get();
            $contest_test2 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 2)->first();
            $chapter2 = Chapters::with(
                array('question.answer.student_answer' => function ($query) use ($user_id) {
                    $query->where('user_id', '=', $user_id);
                })
            )
                ->where('contest_test_id', $contest_test2->id)->get();
            $contest_test3 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 3)->first();
            $chapter3 = Chapters::with(
                array('question.answer.student_answer' => function ($query) use ($user_id) {
                    $query->where('user_id', '=', $user_id);
                })
            )
                ->where('contest_test_id', $contest_test3->id)->get();
            return response()->json(["chapter_1" => $chapter1, "chapter_2" => $chapter2, "chapter_3" => $chapter3]);
        } else {
            $contest_test4 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 4)->first();
            $chapter4 = Chapters::with(
                array('question.answer.student_answer' => function ($query) use ($user_id) {
                    $query->where('user_id', '=', $user_id);
                })
            )
                ->where('contest_test_id', $contest_test4->id)->get();
            $contest_test3 = DB::table('contest_test')->where('test_id', $test_id)->where('contest_id', 3)->first();
            $chapter3 = Chapters::with(
                array('question.answer.student_answer' => function ($query) use ($user_id) {
                    $query->where('user_id', '=', $user_id);
                })
            )
                ->where('contest_test_id', $contest_test3->id)->get();
            return response()->json(["chapter_4" => $chapter4, "chapter_3" => $chapter3]);
        }
    }
    public function getAllResultTestSkill($test_skill_id)
    {
        return response()->json(ResultSkills::with('user')->where("test_skill_id", $test_skill_id)->get());
    }
    public function result_test_skill_detail($test_skill_id, $user_id, $result_skill_id)
    {
        $test_skill = QuestionSkills::with(
            array('answerSkill.student_answer_skill' => function ($query) use ($result_skill_id, $user_id) {
                $query->where('user_id', '=', $user_id);
                $query->where('result_skill_id', '=', $result_skill_id);
            })
        )
            ->where('test_skill_id', $test_skill_id)->get();
        return response()->json($test_skill);
    }
}
