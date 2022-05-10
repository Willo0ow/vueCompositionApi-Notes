<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('notes')
        ->leftJoin('categories', 'categories.id', 'notes.category')
        ->leftJoin('sub_categories', 'sub_categories.id', 'notes.subCategory')
        ->whereNot('status', 100)
        ->select('notes.*', 'categories.name as categoryName', 'sub_categories.name as subCategoryName')
        ->get();
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
    public function store(Request $request)
    {
        $note = Note::create($request->all());
        $noteId = $note->id;
        Log::create(['table'=>'notes', 'variable'=>'status', 'value'=>1, 'elementId'=>$noteId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($note)
    {
        return Note::where('id', $note)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $note)
    {
        Note::where('id', $note)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($note)
    {
        $note = Note::where('id', $note)->first();
        $note->delete();
    }
}
