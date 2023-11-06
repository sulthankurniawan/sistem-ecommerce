<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['data' => $transactions]);
    }
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'customer_address_id' => 'required|exists:customer_addresses,id',
            'product_id' => 'required|exists:products,id',
            'payment_id' => 'required|exists:payments,id',
        ]);

        // Create a new transaction
        $transaction = Transaction::create($validatedData);

        return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json(['data' => $transaction]);
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'customer_id' => 'exists:customers,id',
            'customer_address_id' => 'exists:customer_addresses,id',
            'product_id' => 'exists:products,id',
            'payment_id' => 'exists:payments,id',
        ]);

        $transaction = Transaction::find($id);
        
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->update($validatedData);

        return response()->json(['message' => 'Transaction updated successfully', 'data' => $transaction]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }


}
