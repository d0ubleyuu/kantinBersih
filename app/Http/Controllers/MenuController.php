<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuIngredientRequest;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
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
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $validated = $request->validated();

        $newMenu = new Menu();
        $newMenu->menu_name = $validated['menu_name'];
        $newMenu->selling_price = $validated['selling_price'];

        if ($newMenu->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data menu.',
                'id' => $newMenu->id,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data menu.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();

        $menu->menu_name = $validated['menu_name'];
        $menu->selling_price = $validated['selling_price'];

        if ($menu->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data menu.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data menu.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Gate::authorize('admin-page');

        if ($menu->delete()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menghapus data menu.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data menu.',
            ], 500);
        }
    }

    /**
     * Add ingredient to menu.
     *
     * @param  \App\Http\Requests\MenuIngredientRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function storeIngredient(MenuIngredientRequest $request, Menu $menu)
    {
        $validated = $request->validated();

        $menu->ingredients()->attach($validated['ingredient_id'], [
            'quantity' => $validated['quantity'],
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Berhasil menambah bahan untuk menu.',
        ], 200);
    }

    /**
     * Update ingredient to menu.
     *
     * @param  \App\Http\Requests\MenuIngredientRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function updateIngredient(MenuIngredientRequest $request, Menu $menu, $ingredient)
    {
        $validated = $request->validated();

        $menu->ingredients()->updateExistingPivot($validated['ingredient_id'], [
            'quantity' => $validated['quantity'],
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Berhasil mengubah bahan untuk menu.',
        ], 200);
    }

    public function destroyIngredient(Menu $menu, Ingredient $ingredient)
    {
        Gate::authorize('admin-page');

        if ($menu->ingredients()->detach($ingredient->id) != 0) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menghapus bahan dari menu.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus bahan dari menu.',
            ], 500);
        }
    }
}