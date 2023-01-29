<?php

namespace App\Http\Controllers;

use App\Models\MenuTransaction;
use App\Http\Requests\StoreMenuTransactionRequest;
use App\Http\Requests\UpdateMenuTransactionRequest;

class MenuTransactionController extends Controller
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
     * @param  \App\Http\Requests\StoreMenuTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuTransaction  $menuTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(MenuTransaction $menuTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuTransaction  $menuTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuTransaction $menuTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuTransactionRequest  $request
     * @param  \App\Models\MenuTransaction  $menuTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuTransactionRequest $request, MenuTransaction $menuTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuTransaction  $menuTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuTransaction $menuTransaction)
    {
        //
    }
}
