<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestockRequest;
use App\Models\Ingredient;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use Illuminate\Support\Facades\Gate;

class IngredientController extends Controller
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
     * @param  \App\Http\Requests\StoreIngredientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientRequest $request)
    {
        $validated = $request->validated();

        $newIngredient = new Ingredient();
        $newIngredient->name = $validated['name'];
        $newIngredient->capital_price = $validated['capital_price'];
        $newIngredient->measurement_id = $validated['measurement_id'];

        if ($newIngredient->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data bahan.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data bahan.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredientRequest  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $validated = $request->validated();

        $ingredient->name = $validated['name'];
        $ingredient->capital_price = $validated['capital_price'];
        $ingredient->measurement_id = $validated['measurement_id'];

        if ($ingredient->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data bahan.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data bahan.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        Gate::authorize('admin-page');

        if ($ingredient->delete()) {
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

    /**
     * Restock the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestockRequest  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function restock(RestockRequest $request, Ingredient $ingredient)
    {
        $validated = $request->validated();

        $ingredient->stock = $ingredient->stock + intval($validated['added']);

        if ($ingredient->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menambah stok bahan.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambah stok bahan.',
            ], 500);
        }
    }
}