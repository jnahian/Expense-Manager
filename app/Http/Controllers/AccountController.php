<?php

namespace App\Http\Controllers;

use App\Account;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function accountTypes()
    {
        return $this->successResponse(null, Account::ACCOUNT_TYPES);
    }

    public function index(Request $request)
    {
        $accounts = $this->user
            ->accounts()
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($income) {
                return $this->serialize($income);
            });
        return $this->successResponse('', $accounts);
    }

    private function serialize(Account $account)
    {
        $output                      = $account->toArray();
        $output['balance_converted'] = number_format($account->balance, 2);
        $output['created_at']        = Carbon::parse($account->created_at)->format('d M, Y');
        $output['updated_at']        = Carbon::parse($account->updated_at)->format('d M, Y');
        return $output;
    }

    public function details(Request $request, Account $account)
    {
        return $this->successResponse('', $this->serialize($account));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|string|max:100',
            'type'    => 'required',
            'balance' => 'required|numeric',
            'status'  => 'required|numeric',
        ]);

        try {
            $data = $request->only(['name', 'type', 'balance']);
            $this->user->accounts()->create($data);
            return $this->successResponse('Account created successfully!');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'name'   => 'required|string|max:100',
            'type'   => 'required',
            'status' => 'required|numeric',
        ]);

        try {
            $data = $request->only(['name', 'type', 'status']);
            $account->update($data);
            return $this->successResponse('Account update successfully!', $account);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function delete(Request $request, Account $account)
    {
        $account->delete();
        return $this->successResponse('Account deleted successfully!', $account);
    }
}
