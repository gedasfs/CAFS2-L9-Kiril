<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserAddress;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ====== #1 ====== //
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            UserAddress::factory()->create([
                'user_id' => $user->id
            ]);
        }

        // User::factory()->count(10)->create([
        //     'name' => 'Test User',
        //     // 'email' => 'test@example.com',
        // ]);

        // ====== #2 ====== //
        // UserAddress::factory(10)->create();

        // ====== #3 ====== //
        // User::factory(10)->has(UserAddress::factory()->count(3), 'addresses')->create();
    }
}
