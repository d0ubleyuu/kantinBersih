<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->all();

        $newTransaction = new Transaction();
        $newTransaction->employee_id = Auth::user()->id;
        $newTransaction->transaction_total = $validated['total'];
        $newTransaction->payment_total = $validated['payment'];
        $newTransaction->change = $validated['change'];

        if ($newTransaction->save()) {
            $menus = json_decode($validated['menus']);
            foreach ($menus as $menu) {
                $parsed = json_decode($menu);
                $newTransaction->menus()->attach($parsed->data->id, [
                    'amount' => $parsed->quantity,
                    'total_price' => 0,
                ]);
                // $detailMenu = Menu::find($parsed->data->id);
                // foreach($detailMenu->ingredients as $ingredient) {
                //     $ingredient
                // }
            }

            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data menu.',
                'id' => $newTransaction->id,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data menu.',
            ], 500);
        }

        return response()->json([
            'data' => json_decode(json_decode($validated['menus'])[0]),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}