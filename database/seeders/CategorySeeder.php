<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            Category::create([
                'pl' => ['title' => 'Category PL ' . $i],
                'uk' => ['title' => 'Категорія ' . $i],
                'en' => ['title' => 'Category EN ' . $i],
                'slug' => $faker->slug(2),
                'is_public' => Category::PUBLIC,
            ]);
        }
    }
}
