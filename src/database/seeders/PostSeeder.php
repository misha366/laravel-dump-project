<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $tagIds = Tag::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $post = Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'image' => $faker->imageUrl,
                'category_id' => $faker->numberBetween($min = 1, $max = 20),
            ]);

            $randomTags = $faker->randomELements($tagIds, $faker->numberBetween($min = 1, $max = 5));
            $post->tags()->sync($randomTags);
        }
    }
}
