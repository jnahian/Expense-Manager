<?php

namespace App\Http\Controllers;

use App\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $incomes = $this->user->incomes->map(function ($income) {
            return $this->serialize($income);
        });
        return response()->json($incomes, 200);
    }

    private function serialize(Income $income)
    {
        $output         = $income->toArray();
        $output['date'] = Carbon::parse($income->date)->format('d M, Y');
        return $output;
    }

    public function details(Request $request, Income $income)
    {
        return response()->json($income);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'date'    => 'required|date',
            'source'  => 'required|string|max:150',
            'amount'  => 'required|numeric',
            'remarks' => 'nullable'
        ]);

        $data            = $request->only(['date', 'source', 'amount', 'remarks']);
        $data['user_id'] = $this->user->id;

        return Income::create($data);
    }

    public function update(Request $request, Income $income)
    {
        $this->validate($request, [
            'date'    => 'required|date',
            'source'  => 'required|string|max:150',
            'amount'  => 'required|numeric',
            'remarks' => 'nullable'
        ]);

        $data            = $request->only(['date', 'source', 'amount', 'remarks']);
        $data['user_id'] = $this->user->id;

        $income->fill($data)->save();
        return $income;
    }

    public function delete(Request $request, Income $income)
    {
        $income->delete();
        return $income;
    }
}
