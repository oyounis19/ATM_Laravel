<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Atm;
use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(20)->create();
        // Account::factory(20)->create();
        // Atm::factory(20)->create();
        Admin::factory(20)->create();
    }
}
