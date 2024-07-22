<?php
namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'review_date' => $this->faker->date(),
            'max_level' => $this->faker->numberBetween(1, 5),
            'user_id' => \App\Models\User::factory(),
            'theme_id' => \App\Models\Theme::factory(),
            'level' => $this->faker->numberBetween(1, 5),
        ];
    }
}
