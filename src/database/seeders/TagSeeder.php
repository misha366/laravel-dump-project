<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            Tag::create([
                'title' => $faker->word . $faker->emoji()
            ]);
        }
    }
}
