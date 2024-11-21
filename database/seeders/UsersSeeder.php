<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User([
            'name' => 'Laci',
            'email' => 'laci@laci.hu',
            'email_verified_at' => now(),
            'password' => Hash::make('Laci1234'),
        ]);
        $user->save();
    }
}
