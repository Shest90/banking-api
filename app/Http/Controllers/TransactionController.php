<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Создание транзакции (перевод средств)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account' => 'required|exists:bank_accounts,id',
            'to_account'   => 'required|exists:bank_accounts,id|different:from_account',
            'amount'       => 'required|numeric|min:0.01',
            'comment'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            $fromAccount = BankAccount::where('id', $request->from_account)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            $toAccount = BankAccount::findOrFail($request->to_account);

            if ($fromAccount->money_amount < $request->amount) {
                return response()->json(['error' => 'Недостаточно средств'], 400);
            }

            // Обновляем балансы
            $fromAccount->money_amount -= $request->amount;
            $toAccount->money_amount += $request->amount;

            $fromAccount->save();
            $toAccount->save();

            $transaction = Transaction::create([
                'user_id'      => Auth::id(),
                'from_account' => $fromAccount->id,
                'to_account'   => $toAccount->id,
                'amount'       => $request->amount,
                'comment'      => $request->comment,
            ]);

            DB::commit();
            return response()->json($transaction, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Ошибка транзакции', 'details' => $e->getMessage()], 500);
        }
    }

    // Получение истории транзакций
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return response()->json($transactions);
    }
}
