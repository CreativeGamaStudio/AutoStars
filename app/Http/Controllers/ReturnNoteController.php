<?php

namespace App\Http\Controllers;

use App\DataTables\ReturnNoteDataTable;
use App\Models\ReturnNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('return_notes.index', compact('returnNote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnNote $returnNote)
    {
        return redirect()->route('return_notes.index')->with('success', 'Return Notes edited successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return redirect()->route('return_notes.index')->with(
                'error',
                implode(", ", $messages)
            );
        }
        $item = ReturnNote::find($id);
        $item->date = $request->date;
        $item->save();
        return redirect()->route('return_notes.index')->with('success', 'Return Notes has been updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnNote  $returnNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = ReturnNote::find($request->id);
        if ($item) {
            $item->delete();
        }

        return redirect()->route('return_notes.index')->with('success', 'Return Notes has been deleted successfully.');
    }
}
