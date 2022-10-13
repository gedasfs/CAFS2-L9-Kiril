<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cart;
use App\Models\User;
use App\Models\UserAddress;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cart::factory(3)->create();

        Cart::factory(3)->create([
            'user_id' => User::factory()->has(UserAddress::factory()->count(3), 'addresses')
        ]);
    }
}
