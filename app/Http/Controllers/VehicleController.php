<?php

namespace App\Http\Controllers;

use App\DataTables\VehicleDataTable;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validatedData = $request->validate([
            'plate_number' => 'required|string|max:16',
            'engine_number' => 'required|string|max:12',
            'type' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'merk' => 'required|string|max:50',
            'year' => 'required|integer|min:1900'
        ]);

        $vehicle = new Vehicle();
        $vehicle->plate_number = $validatedData['plate_number'];
        $vehicle->engine_number = $validatedData['engine_number'];
        $vehicle->type = $validatedData['type'];
        $vehicle->color = $validatedData['color'];
        $vehicle->merk = $validatedData['merk'];
        $vehicle->year = $validatedData['year'];

        if ($vehicle->save()) {
            return redirect()->route('vehicles.index')->with('success', 'Vehicle has been created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create vehicle. Please try again.');
        }
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
        $validatedData = $request->validate([
            'plate_number' => 'required|string|max:16',
            'engine_number' => 'required|string|max:12',
            'type' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'merk' => 'required|string|max:50',
            'year' => 'required|integer|min:1900'
        ]);
        $vehicle = Vehicle::find($id);


        $vehicle->plate_number = $validatedData['plate_number'];
        $vehicle->engine_number = $validatedData['engine_number'];
        $vehicle->type = $validatedData['type'];
        $vehicle->color = $validatedData['color'];
        $vehicle->merk = $validatedData['merk'];
        $vehicle->year = $validatedData['year'];

        if ($vehicle->save()) {
            return redirect()->route('vehicles.index')->with('success', 'Vehicle has been updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update vehicle. Please try again.');
        }
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
        if ($item) {
            $item->delete();
        }

        return redirect()->route('vehicles.index')->with('success', 'Vehicle has been deleted successfully.');
    }
}
