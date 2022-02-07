<?php

namespace App\Http\Controllers;

use App\FlashcardTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashCardTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(FlashcardTitle::where('user_id', Auth::id())->get());
    }
    public function all()
    {
        return response()->json(FlashcardTitle::with('user')->where('public', 1)->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flashcards = new FlashcardTitle();
        $flashcards->fill($request->all());
        $flashcards->user_id = Auth::id();
        $flashcards->save();
        return response()->json($flashcards);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $flashcards = FlashcardTitle::find($id);
        $flashcards->name = $request->name;
        $flashcards->public = $request->public;
        $flashcards->save();
        return response()->json($flashcards);
    }
    public function updatePublic(Request $request, $id)
    {
        $flashcards = FlashcardTitle::find($id);
        $flashcards->public = $request->public;
        $flashcards->save();
        return response()->json($flashcards);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FlashcardTitle::destroy($id);
        return response()->json(["success" => "success"]);
    }
}
