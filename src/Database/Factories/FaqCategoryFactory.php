<?php

namespace Agenciafmd\Faqs\Database\Factories;

use Agenciafmd\Faqs\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqCategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'is_active' => $this->faker->optional(0.3, 1)
                ->randomElement([0]),
            'name' => $this->faker->sentence(),
        ];
    }
}
