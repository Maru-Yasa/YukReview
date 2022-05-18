<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'admin',
            'email' => 'maruf@gmail.com',
            'password' => Hash::make('maruf130205'),
            'gender' => 'male',
            'role' => 'admin' 
        ]);

    	$faker = Faker::create('id_ID');
        for ($i=0; $i < 100; $i++) { 
            $gender = $faker->randomElement(['male','female','other']);
            User::create([
                'name' => $faker->name($gender),
                'email'=> $faker->email(),
                'password' => Hash::make($faker->password(10)),
                'gender' => $gender,
            ]);
        }
    }
}
