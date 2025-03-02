<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    // Создание нового банковского аккаунта
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_id'        => 'required|exists:banks,id',
            'account_number' => 'required|string|unique:bank_accounts',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $account = BankAccount::create([
            'user_id'        => Auth::id(),
            'bank_id'        => $request->bank_id,
            'account_number' => $request->account_number,
            'money_amount'   => 1000,
        ]);

        return response()->json($account, 201);
    }

    // Получение списка банковских аккаунтов текущего пользователя
    public function index()
    {
        $accounts = Auth::user()->bankAccounts;
        return response()->json($accounts);
    }

    // Получение информации о конкретном аккаунте
    public function show($id)
    {
        $account = BankAccount::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return response()->json($account);
    }

    // Удаление аккаунта
    public function destroy($id)
    {
        $account = BankAccount::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $account->delete();
        return response()->json(['message' => 'Аккаунт удалён']);
    }
}
