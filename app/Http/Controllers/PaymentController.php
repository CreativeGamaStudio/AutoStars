<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaymentDataTable $dataTable)
    {
        return $dataTable->render('payments.index');
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
            'price' => 'required',
            'discount' => 'required',
            'date' => 'required',
            'card_number' => 'required',
            'giro_number' => 'required',
        ]);

        // create user
        $payment = Payment::create([
            'price' => $request->price,
            'discount' => $request->discount,
            'date' => $request->date,
            'card_number' => $request->card_number,
            'giro_number' => $request->giro_number,
        ]);

        // redirect to index
        return redirect()->route('payments.index')->with('success', 'Invoices created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payments.index', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required',
            'discount' => 'required',
            'date' => 'required',
            'card_number' => 'required',
            'giro_number' => 'required',
        ]);
        $item = Payment::find($id);
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->date = $request->date;
        $item->card_number = $request->card_number;
        $item->giro_number = $request->giro_number;
        $item->save();
        
        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Payment::find($request->id);
        if ($item)
        {
            $item->delete();
        }

        return redirect()->route('payments.index')->with('success', 'Invoices has been deleted successfully.');
    }
}
