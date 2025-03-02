<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    public function run()
    {
        Bank::create([
            'name' => 'Test Bank',
            'code' => 'TEST'
        ]);
    }
}
