<?php

namespace App\Http\Controllers;

use App\DataTables\PartDataTable;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartDataTable $dataTable)
    {
        return $dataTable->render('parts.index');
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
            'barcode' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'selling_price' => 'required',
            'purchase_price' => 'required',
            
        ]);

         // create parts
         $part = Part::create([
            'name' => $request->name,
            'barcode' => $request->barcode,
            'qty' => $request->qty,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect()->route('parts.index')->with('success', 'Parts has been updated successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        return redirect()->route('parts.index')->with('success', 'Parts has been updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'barcode' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);
        $item = Part::find($id);
        $item->name = $request->name;
        $item->barcode = $request->barcode;
        $item->qty = $request->qty;
        $item->purchase_price = $request->purchase_price;
        $item->selling_price = $request->selling_price;
        $item->save();
        
        return redirect()->route('parts.index')->with('success', 'Parts has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        //
    }
}
