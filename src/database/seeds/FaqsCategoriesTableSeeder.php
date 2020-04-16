<?php

use Agenciafmd\Faqs\Category;
use Illuminate\Database\Seeder;

class FaqsCategoriesTableSeeder extends Seeder
{
    protected $total = 10;

    public function run()
    {
        Category::withTrashed()
            ->where('type', 'faqs-categories')
            ->get()->each->forceDelete();

        if (!config('admix-faqs.category')) {
            return false;
        }

        if (config('admix-categories.faqs-categories.items')) {
            $this->staticItems();

            return false;
        }

        $this->factoryItems();

    }

    private function factoryItems()
    {
        $this->command->getOutput()
            ->progressStart($this->total);
        factory(Category::class, $this->total)
            ->create()
            ->each(function () {
                $this->command->getOutput()
                    ->progressAdvance();
            });
        $this->command->getOutput()
            ->progressFinish();
    }

    private function staticItems()
    {
        $items = collect(config('admix-categories.faqs-categories.items'));

        $this->command->getOutput()
            ->progressStart($items->count());
        $items->each(function ($item) {
            Category::create([
                'is_active' => '1',
                'name' => $item,
            ]);
            $this->command->getOutput()
                ->progressAdvance();
        });
        $this->command->getOutput()
            ->progressFinish();

    }
}
