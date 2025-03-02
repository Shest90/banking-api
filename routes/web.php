<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzQwOTMxMDIyLCJleHAiOjE3NDA5MzQ2MjIsIm5iZiI6MTc0MDkzMTAyMiwianRpIjoiSGJXT1JRbjRXakRsZ3NnMCIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Ihab5lM3oxwhs8Nq-B3kfPLz-T3CKYuWxRt5MnAlqQ8"