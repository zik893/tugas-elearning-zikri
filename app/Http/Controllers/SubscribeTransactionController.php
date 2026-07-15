<?php

namespace App\Http\Controllers;

use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SubscribeTransaction::with('user')->orderBy('id', 'desc')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not used
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribeTransaction $subscribeTransaction)
    {
        return view('admin.transactions.show', compact('subscribeTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribeTransaction $subscribeTransaction)
    {
        // Not used
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribeTransaction $subscribeTransaction)
    {
        DB::transaction(function () use ($subscribeTransaction) {
            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => now(),
            ]);
        });

        return redirect()->route('admin.subscribe_transactions.show', $subscribeTransaction)
            ->with('success', 'Transaksi berhasil di-approve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        // Not used
    }
}
