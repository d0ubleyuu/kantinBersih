<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Http\Requests\StoreMeasurementRequest;
use App\Http\Requests\UpdateMeasurementRequest;
use Illuminate\Support\Facades\Gate;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMeasurementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeasurementRequest $request)
    {
        $validated = $request->validated();

        $newMeasurement = new Measurement();
        $newMeasurement->long_name = $validated['long_name'];
        $newMeasurement->short_name = $validated['short_name'];

        if ($newMeasurement->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data takaran.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data takaran.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement $measurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurement $measurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeasurementRequest  $request
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasurementRequest $request, Measurement $measurement)
    {
        $validated = $request->validated();

        $measurement->long_name = $validated['long_name'];
        $measurement->short_name = $validated['short_name'];

        if ($measurement->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data takaran.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data takaran.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measurement $measurement)
    {
        Gate::authorize('admin-page');

        if ($measurement->delete()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menghapus data takaran.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data takaran.',
            ], 500);
        }
    }
}