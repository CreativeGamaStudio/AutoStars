<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('orders.index');
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
            'order' => 'required',
            'complaint' => 'required',
        ]);

        // create user
        $order = Order::create([
            'date' => $request->date,
            'order' => $request->order,
            'complaint' => $request->complaint,
        ]);

        // redirect to users.index
        return redirect()->route('orders.index')->with('success', 'Orders created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.index', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return redirect()->route('orders.index')->with('success', 'Orders created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'order' => 'required',
            'complaint' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return redirect()->route('orders.index')->with(
                'error',
                implode(", ", $messages)
            );
        }

        $item = Order::find($id);
        $item->date = $request->date;
        $item->order = $request->order;
        $item->complaint = $request->complaint;
        $item->save();
        return redirect()->route('orders.index')->with('success', 'Orders created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Order::find($request->id);
        if ($item) {
            $item->delete();
        }

        return redirect()->route('orders.index')->with('success', 'customer has been deleted successfully.');
    }
}
