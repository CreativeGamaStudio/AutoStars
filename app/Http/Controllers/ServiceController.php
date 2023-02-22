<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('services.index');
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
            'cost' => 'required',
        ]);

        // create user
        $service = Service::create([
            'name' => $request->name,
            'cost' => $request->cost,
        ]);

        // redirect to index
        return redirect()->route('services.index')->with('success', 'Services created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.index', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return redirect()->route('services.index')->with('success', 'Services updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->cost = $request->cost;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Services updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $service = service::find($request->id);
        if ($service) {
            $service->delete();
        }

        return redirect()->route('services.index')->with('danger', 'service has been deleted successfully.');
    }
}
