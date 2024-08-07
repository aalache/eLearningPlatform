<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Job;
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

        $user = User::factory()->create([
            'name' => 'Omar',
            'email' => 'test@example.com',
            'password' => Hash::make('123456'),
        ]);

        $this->call(RolesTableSeeder::class);

        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);

        $this->call(VideosSeeder::class);
    }
}
