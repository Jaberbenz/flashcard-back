<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        return [
            'front_text' => $this->faker->sentence,
            'front_image' => $this->faker->imageUrl(),
            'front_video' => $this->faker->url,
            'front_audio' => $this->faker->url,
            'back' => $this->faker->paragraph,
            'theme_id' => \App\Models\Theme::factory(),
        ];
    }
}
