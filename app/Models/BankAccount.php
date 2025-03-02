<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'user_id',
        'bank_id',
        'account_number',
        'money_amount',
    ];

    // Связь: банковский аккаунт принадлежит пользователю
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь: банковский аккаунт принадлежит банку
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    // Связь: транзакции, где аккаунт используется как отправитель
    public function transactionsFrom()
    {
        return $this->hasMany(Transaction::class, 'from_account');
    }

    // Связь: транзакции, где аккаунт используется как получатель
    public function transactionsTo()
    {
        return $this->hasMany(Transaction::class, 'to_account');
    }
}
