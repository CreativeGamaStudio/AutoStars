<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customers.index');
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
            'name' => 'required',
            'phone_number' => 'required|max:13',
            'address' => 'required',
            'city' => 'required',
        ]);

        // create user
        $customer = Customer::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        // redirect to users.index
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.index', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return redirect()->route('customers.index')->with('success', 'customer has been updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|max:13',
            'address' => 'required',
            'city' => 'required',
        ]);
        $item = Customer::find($id);
        $item->name = $request->name;
        $item->address = $request->address;
        $item->phone_number = $request->phone_number;
        $item->city = $request->city;
        $item->save();
        return redirect()->route('customers.index')->with('success', 'customer has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Customer $customer)
    // {
    //     $customer->delete();

    //     return redirect()->route('customers.index')->with('success', 'customer has been deleted successfully.');
    // }
    public function destroy(Request $request, $id)
    {
        $item = Customer::find($request->id);
        if ($item) {
            $item->delete();
        }

        return redirect()->route('customers.index')->with('success', 'customer has been deleted successfully.');
    }
}
