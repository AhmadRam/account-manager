<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'ahmadram'],
            [
                'name' => 'Ahmad Ram',
                'email' => 'ahmadram',
                'password' => Hash::make('624708'),
                'email_verified_at' => now(),
            ]
        );
    }
}
