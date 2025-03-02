<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Связь: пользователь имеет много банковских аккаунтов
    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    // Связь: пользователь имеет много транзакций
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Методы для JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
