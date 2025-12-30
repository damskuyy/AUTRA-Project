<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensor = DB::table('sensor_logs')->latest()->first();
        return view('dashboard.index', compact('sensor'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('sensor_logs')->insert([
            'sensor1' => $request->sensor1,
            'sensor2' => $request->sensor2,
            'sensor3' => $request->sensor3,
            'created_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
