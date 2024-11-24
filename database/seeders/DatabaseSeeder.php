<?php

namespace Database\Seeders;

use Database\Seeders\ChatroomTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ChatroomTableSeeder::class);
    }
}
