<?php

namespace App\Http\Controllers;

use App\FlashcardContent;
use App\FlashcardTitle;
use FlashcardTitleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashCardContentController extends Controller
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
        $flashCard = new FlashcardContent();
        $flashCard->fill($request->all());
        $flashCard->save();
        return response()->json($flashCard);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(FlashcardContent::where('flashcard_title_id', $id)->get());
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
        $flashCard = FlashcardContent::find($id);
        $flashCard->front = $request->front;
        $flashCard->back = $request->back;
        $flashCard->save();
        return response()->json($flashCard);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FlashcardContent::destroy($id);
        return response()->json(["success" => "success"]);
    }
    public function myFlashcards()
    {
        return response()->json(FlashcardTitle::where('user_id', Auth::id())->get());
    }
    public function myFlashcard($id)
    {
        return response()->json(FlashcardContent::inRandomOrder()->where('flashcard_title_id', $id)->get());
    }
}
