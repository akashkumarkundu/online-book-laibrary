<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GradeLevelSeeder::class,
            SubjectSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
        ]);
    }
}
