<?php

namespace App\Http\Controllers;

use App\DataTables\ReturnNoteDataTable;
use App\Models\ReturnNote;
use Illuminate\Http\Request;

class ReturnNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReturnNoteDataTable $dataTable)
    {
        return $dataTable->render('return_notes.index');
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
        $request->validate([
            'date' => 'required',
        ]);

        // create user
        $return_note = ReturnNote::create([
            'date' => $request->date,
        ]);

        // redirect to index
        return redirect()->route('return_notes.index')->with('success', 'Return Notes created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnNote $returnNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnNote $returnNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnNote $returnNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $returnnote = returnnote::find($request->id);
        if ($returnnote) {
            $returnnote->delete();
        }

        return redirect()->route('returnnotes.index')->with('success', 'returnnote has been deleted successfully.');
    }
}
