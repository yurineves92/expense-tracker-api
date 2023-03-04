<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->get();

        return response()->json(
            [
                "data" => [
                    "transactions" => $transactions,
                ],
            ],
            200
        );
    }

    public function balance(Request $request)
    {

    }

    public function show($id)
    {
        return response()->json(
            [
                "data" => [
                    'transaction' => Transaction::find($id)
                ]
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json(
            [
                "data" => [
                    "message" => 'Transaction created successfully.',
                    '$transaction' => $transaction
                ]
            ],
            201
        );
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
