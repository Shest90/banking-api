<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Получение всех пользователей
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
}
