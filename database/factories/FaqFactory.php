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
            'is_active' => fake()->optional(0.3, 1)
                ->randomElement([0]),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraphs(3, true),
            'sort' => fake()->optional()
                ->numberBetween(1, 999),
        ];
    }
}
