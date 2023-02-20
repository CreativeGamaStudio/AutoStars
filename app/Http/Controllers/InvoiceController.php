<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'invoice_date' => 'required',
            'total' => 'required',
            'paid' => 'required',
        ]);

        // create user
        $invoice = Invoice::create([
            'invoice_date' => $request->invoice_date,
            'total' => $request->total,
            'paid' => $request->paid,
        ]);

        // redirect to users.index
        return redirect()->route('invoices.index')->with('success', 'Invoices created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.index', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return redirect()->route('invoices.index')->with('success', 'Invoices has been updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_date' => 'required',
            'total' => 'required',
            'paid' => 'required',
        ]);
        $item = Invoice::find($id);
        $item->invoice_date = $request->invoice_date;
        $item->total = $request->total;
        $item->paid = $request->paid;
        $item->save();
        
        return redirect()->route('items.index')->with('success', 'item has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Invoice::find($request->id);
        if ($item)
        {
            $item->delete();
        }

        return redirect()->route('invoices.index')->with('success', 'Invoices has been deleted successfully.');
    }
}
