<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'test',
                'name' => 'test test',
                'email' => 'test@test.com',
                'mobile' => '09120001111',
                'birthday' => fake()->dateTime(),
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'navid',
                'name' => 'navid mansouri',
                'email' => 'navid@navid.com',
                'mobile' => '09120002222',
                'birthday' => fake()->dateTime(),
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'omid',
                'name' => 'omid mansouri',
                'email' => 'omid@omid.com',
                'mobile' => '09120003333',
                'birthday' => fake()->dateTime(),
                'password' => Hash::make('12345678'),
            ]
        ];
        foreach ($users as $user)
        {
            $record = User::whereUsername($user['username'])->first();
            if (!$record) {
                User::create($user);
            }
        }
    }
}
