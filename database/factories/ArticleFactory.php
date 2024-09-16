<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->word,
            "body" => $this->faker->paragraphs(3, true),
            "imagefile" => $this->imgFilenameGenerator(true),
            "premium" => $this->faker->boolean(25),
            "user_id" => User::inRandomOrder()->first()->id,
        ];
    }

    protected function imgFilenameGenerator($nullable = false, $nullChance = 50) {

        if($nullable){
            if(rand(0, 100) > $nullChance){
                return null;
            }
        }

        return (string)rand(1, 5) . ".png";
    }
}
