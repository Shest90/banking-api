<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'from_account',
        'to_account',
        'amount',
        'comment',
    ];

    // Связь: транзакция принадлежит пользователю (инициатору)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь: транзакция ссылается на исходящий банковский аккаунт
    public function fromAccount()
    {
        return $this->belongsTo(BankAccount::class, 'from_account');
    }

    // Связь: транзакция ссылается на входящий банковский аккаунт
    public function toAccount()
    {
        return $this->belongsTo(BankAccount::class, 'to_account');
    }
}
