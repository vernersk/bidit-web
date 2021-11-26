<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function getById($transactionId)
    {
        $transaction = Transaction::query()
            ->where('id', '=', $transactionId)
            ->firstOrFail();

        return $transaction;
    }

    public function updateTransaction(Request $request)
    {
        $transaction = Transaction::find($request->transactionId);
        if($request->status) { $transaction->status = $request->status; }
        if($request->packageId) { $transaction->package_id = $request->packageId; }
        $transaction->save();
        return "Dati veiksmīgi atjaunoti!";
    }
}
