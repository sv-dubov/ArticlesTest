<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Seo;
use App\Models\Text;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            $article = Article::create([
                'category_id' => Category::all()->random()->id,
                'pl' => ['title' => 'pl ' . $faker->sentence(5), 'subtitle' => 'pl ' . $faker->sentence(5)],
                'uk' => ['title' => 'uk ' . $faker->sentence(5), 'subtitle' => 'uk ' . $faker->sentence(5)],
                'en' => ['title' => 'en ' . $faker->sentence(5), 'subtitle' => 'en ' . $faker->sentence(5)],
                'slug' => $faker->slug(5),
                'image' => null,
                'publish_date' => $faker->dateTimeBetween('-1 week', now()),
                'is_public' => Article::PUBLIC,
            ]);

            Text::create([
                'article_id' => $article->id,
                'sequence_number' => 1,
                'pl' => ['content' => 'pl ' . $faker->text(8000)],
                'uk' => ['content' => 'uk ' . $faker->text(8000)],
                'en' => ['content' => 'en ' . $faker->text(8000)],
            ]);

            Seo::create([
                'article_id' => $article->id,
                'pl' => ['title' => 'pl ' . $faker->sentence(3), 'description' => 'pl ' . $faker->sentence(4)],
                'uk' => ['title' => 'uk ' . $faker->sentence(3), 'description' => 'uk ' . $faker->sentence(4)],
                'en' => ['title' => 'en ' . $faker->sentence(3), 'description' => 'en ' . $faker->sentence(4)],
            ]);
        }
    }
}
