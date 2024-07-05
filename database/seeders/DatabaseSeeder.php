<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
        $this->call([PostSeeder::class]);
        User::factory()->createMany([
            [
            'name' => 'Test User',
            'email' => 'test@example.com',
            ],
            [
            'name' => 'solomon',
            'email' => 'solomon@nabiyot.com',
            ],
    ]);

    }
}