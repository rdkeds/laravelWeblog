<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::factory()->count(100)->create();

        foreach($articles as $article){

            $article->category()->sync(Category::inRandomOrder()->take(rand(0, 3))->get());
            
        }
    }
}
