<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestStoreRequest;
use App\Tests;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tests::with('level', 'user')->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestStoreRequest $request)
    {
        try {
            $test = new Tests();
            $test->fill($request->all());
            $test->active = $request->public;
            $test->user_id = Auth::id();
            $test->save();
            $test_id = $test->id;
            $contest_test = Tests::find($test_id);
            if ($request->level_id > 4) {
                $contest_test->contest()->attach([4, 3]);
            } else {
                $contest_test->contest()->attach([1, 2, 3]);
            }
        } catch (QueryException $ex) {
            return response()->json(['error' => $ex]);
        }
        return response()->json($test);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(TestStoreRequest $request, $id)
    {
        $test = Tests::find($id);
        $test->fill($request->all());
        $test->active = $request->public;
        $test->save();
        return response()->json($test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tests::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
