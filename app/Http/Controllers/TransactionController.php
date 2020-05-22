<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionMeta()
    {
        $accounts = $this->user->accounts()->active()->get(['id', 'name', 'type', 'balance'])->toArray();
        $data     = [
            'accounts' => $accounts,
            'types'    => Transaction::TYPES,
            'status'   => Transaction::STATUS,
        ];
        return $this->successResponse(null, $data);
    }

    public function index(Request $request)
    {
        $transactions = $this->user
            ->transactions()
            ->latest()
            ->get()
            ->map(function ($transaction) {
                return $this->serialize($transaction);
            });
        return $this->successResponse('', $transactions);
    }

    private function serialize(Transaction $transaction)
    {
        $transaction->load('account');
        $output                     = $transaction->toArray();
        $output['amount_converted'] = number_format($transaction->amount, 2);
        $output['date_formatted']   = Carbon::parse($transaction->date)->format('d M, Y');
        $output['created_at']       = Carbon::parse($transaction->created_at)->format('d M, Y');
        $output['updated_at']       = Carbon::parse($transaction->updated_at)->format('d M, Y');
        return $output;
    }

    public function details(Request $request, Transaction $transaction)
    {
        return $this->successResponse('', $this->serialize($transaction));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|numeric',
            'date'    => 'required|date',
            'type'    => 'required',
            'amount'  => 'required|numeric',
            'desc'    => 'nullable|string',
            'status'  => 'required|numeric',
        ]);

        try {
            $data               = $request->only(['date', 'type', 'amount', 'desc', 'status']);
            $data['account_id'] = $request->get('account');
            $this->user->transactions()->create($data);
            return $this->successResponse('Transaction saved successfully!');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'account' => 'required|numeric',
            'date'    => 'required|date',
            'type'    => 'required',
            'amount'  => 'required|numeric',
            'desc'    => 'nullable|string',
            'status'  => 'required|numeric',
        ]);

        try {
            $data               = $request->only(['date', 'type', 'amount', 'desc', 'status']);
            $data['account_id'] = $request->get('account');
            $transaction->update($data);
            return $this->successResponse('Transaction update successfully!', $transaction);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function delete(Request $request, Transaction $transaction)
    {
        $transaction->delete();
        return $this->successResponse('Transaction deleted successfully!', $transaction);
    }
}
