<?php

use Agenciafmd\Faqs\Faq;
use Agenciafmd\Faqs\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsTableSeeder extends Seeder
{
    protected $total = 50;

    public function run()
    {
        Faq::withTrashed()
            ->get()->each->forceDelete();

        $faker = Faker\Factory::create('pt_BR');

        $categories = Category::pluck('id');

        $this->command->getOutput()
            ->progressStart($this->total);
        factory(Faq::class, $this->total)
            ->create()
            ->each(function ($faq) use ($faker, $categories) {
                $faq->category_id = ($faker->randomElement($categories)) ?? 0;

                $faq->save();

                $this->command->getOutput()
                    ->progressAdvance();
            });
        $this->command->getOutput()
            ->progressFinish();
    }
}
