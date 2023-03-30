<?php

namespace App\Http\Controllers;

use App\DataTables\VehicleDataTable;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VehicleDataTable $dataTable)
    {
        return $dataTable->render('vehicles.index');
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
            'plate_number' => 'required|string|max:16',
            'engine_number' => 'required|string|max:12',
            'type' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'merk' => 'required|string|max:50',
            'year' => 'required|string|max:4',
        ]);

        // create user
        $user = Vehicle::create([
            'plate_number' => $request->plate_number,
            'engine_number' => $request->engine_number,
            'type' => $request->type,
            'color' => $request->color,
            'merk' => $request->merk,
            'year' => $request->year,
        ]);

        // redirect to users.index
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.'); //user diganti
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.index', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'plate_number' => 'required',
            'engine_number' => 'required',
            'type' => 'required',
            'color' => 'required',
            'merk' => 'required',
            'year' => 'required',
            
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            return redirect()->route("vehicles.index")->with(
                'error', 
                implode(", ", $messages)
            );
        }

        $item = Vehicle::find($id);
        $item->plate_number = $request->plate_number;
        $item->engine_number = $request->engine_number;
        $item->type = $request->type;
        $item->color = $request->color;
        $item->merk = $request->merk;
        $item->year = $request->year;
        $item->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Vehicle::find($id);
        if ( $item) {
            $item->delete();
        }

        return redirect()->route('vehicles.index')->with('success', 'Vehicle has been deleted successfully.');
    }
}
