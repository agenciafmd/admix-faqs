<?php

namespace Agenciafmd\Faqs\Database\Factories;

use Agenciafmd\Faqs\Models\Category;
use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition()
    {
        $categories = Category::pluck('id')
            ->toArray();

        return [
            'is_active' => $this->faker->optional(0.3, 1)
                ->randomElement([0]),
            'star' => $this->faker->optional(0.3, 1)
                ->randomElement([0]),
            'category_id' => config('admix-faqs.category') ? $this->faker->randomElement($categories) : 0,
            'name' => $this->faker->sentence(),
            'call' => config('admix-faqs.call') ? $this->faker->sentence() : null,
            'short_description' => config('admix-faqs.short_description') ? (config('admix-faqs.wysiwyg') ? "<p>{$this->faker->paragraph}</p>" : $this->faker->paragraph) : null,
            'description' => config('admix-faqs.wysiwyg') ? '<p>' . collect($this->faker->paragraphs(5, false))->implode('</p><p>') . '</p>' : $this->faker->paragraphs(5, true),
            'published_at' => config('admix-faqs.published_at') ? $this->faker->dateTimeBetween('-15 days', '15 days')
                ->format('Y-m-d\TH:i') : null,
        ];
    }
}