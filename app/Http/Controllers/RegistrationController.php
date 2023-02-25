<?php

namespace App\Http\Controllers;

use App\DataTables\RegistrationDataTable;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegistrationDataTable $dataTable)
    {
        return $dataTable->render('registrations.index');
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
            'police_number' => 'required',
            'date' => 'required',
            'odometer' => 'required',
            'pkb_flag' => 'required',
            'status' => 'required',
        ]);

        // create user
        $registration = Registration::create([
            'barcode' => $request->barcode,
            'date' => $request->date,
            'police_number' => $request->police_number,
            'odometer' => $request->odometer,
            'pkb_flag' => $request->pkb_flag,
            'status' => $request->status,
        ]);

        // redirect to users.index
        return redirect()->route('registrations.index')->with('success', 'Registration created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        return view('registrations.index', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        return redirect()->route('registrations.index')->with('success', 'Registration created successfully.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'barcode' => 'required',
            'police_number' => 'required',
            'date' => 'required',
            'odometer' => 'required',
            'pkb_flag' => 'required',
            'status' => 'required',
        ]);
        $item = Registration::find($id);
        $item->barcode = $request->barcode;
        $item->police_number = $request->police_number;
        $item->date = $request->date;
        $item->odometer = $request->odometer;
        $item->pkb_flag = $request->pkb_flag;
        $item->status = $request->status;
        $item->save();

        return redirect()->route('registrations.index')->with('success', 'Registration created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $item = Registration::find($request->id); //invoice ginti
        if ($item)
        {
            $item->delete();
        }

        return redirect()->route('registrations.index')->with('success', 'Register has been deleted successfully.'); //invoice ginti
    }
}
