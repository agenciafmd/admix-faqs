<?php

use Agenciafmd\Faqs\Faq;

$factory->define(Faq::class, function (\Faker\Generator $faker) {

    return [
        'is_active' => $faker->optional(0.3, 1)
            ->randomElement([0]),
        'star' => $faker->optional(0.3, 1)
            ->randomElement([0]),
        'category_id' => 0,
        'name' => $faker->sentence(),
        'call' => config('admix-faqs.call') ? $faker->sentence() : null,
        'short_description' => config('admix-faqs.short_description') ? (config('admix-faqs.wysiwyg') ? "<p>{$faker->paragraph}</p>" : $faker->paragraph) : null,
        'description' => config('admix-faqs.wysiwyg') ? '<p>' . collect($faker->paragraphs(5, false))->implode('</p><p>') . '</p>' : $faker->paragraphs(5, true),
        'published_at' => config('admix-faqs.published_at') ? $faker->dateTimeBetween('-15 days', '15 days')
            ->format('Y-m-d\TH:i') : null,
    ];
});
