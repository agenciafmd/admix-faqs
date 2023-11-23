<?php

namespace Agenciafmd\Faqs\Database\Factories;

use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'is_active' => $this->faker->optional(0.3, 1)
                ->randomElement([0]),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'sort' => $this->faker->optional()
                ->numberBetween(1, 999),
        ];
    }
}
