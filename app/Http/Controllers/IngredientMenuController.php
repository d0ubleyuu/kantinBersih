<?php

namespace App\Http\Controllers;

use App\Models\IngredientMenu;
use App\Http\Requests\StoreIngredientMenuRequest;
use App\Http\Requests\UpdateIngredientMenuRequest;

class IngredientMenuController extends Controller
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
     * @param  \App\Http\Requests\StoreIngredientMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IngredientMenu  $ingredientMenu
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientMenu $ingredientMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IngredientMenu  $ingredientMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(IngredientMenu $ingredientMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredientMenuRequest  $request
     * @param  \App\Models\IngredientMenu  $ingredientMenu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientMenuRequest $request, IngredientMenu $ingredientMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IngredientMenu  $ingredientMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientMenu $ingredientMenu)
    {
        //
    }
}
