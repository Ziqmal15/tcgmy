<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name' => 'User Ali',
                'email' => 'aliuser@gmail.com',
                'password' => Hash::make('user12345'),
                'roles' => 0
            ],
            [
                'name' => 'Seller Anis',
                'email' => 'anis_theseller@gmail.com',
                'password' => Hash::make('anis12345'),
                'roles' => 1
            ],
            [
                'name' => 'Admin Ajiq',
                'email' => 'ajiqadmin@gmail.com',
                'password' => Hash::make('ajiq12345'),
                'roles' => 2
            ],
        ])->each(function (User $user) {
            if ($user->roles === 0) {
                $user->cart()->firstOrCreate([
                    'user_id' => $user->id
                ]);
            }
        });
        $this->call([
            CardSeeder::class,
            CouponSeeder::class,
        ]);
    }
}
