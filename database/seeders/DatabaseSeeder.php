<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $array = [
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Superadmin123:)'),
                'role' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        foreach ($array as $key => $row) {
            User::insert($row);
        }
    }
}
