<?php

namespace Agenciafmd\Faqs\Database\Seeders;

use Agenciafmd\Faqs\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FaqsCategoriesTableSeeder extends Seeder
{
    protected int $total = 10;

    public function run()
    {
        Category::withTrashed()
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

        $faker = Factory::create('pt_BR');

        Category::factory($this->total)
            ->create()
            ->each(function ($category) use ($faker) {
                foreach (config('upload-configs.faqs-categories') as $key => $image) {
                    $fakerDir = __DIR__ . '/../Faker/faqs-categories/' . $key;

                    if ($image['faker_dir']) {
                        $fakerDir = $image['faker_dir'];
                    }

                    if ($image['multiple']) {
                        $items = $faker->numberBetween(0, 6);
                        for ($i = 0; $i < $items; $i++) {
                            $sourceFile = $faker->file($fakerDir, storage_path('admix/tmp'));
                            $targetFile = Storage::putFile('tmp', new HttpFile($sourceFile));

                            $category->doUploadMultiple($targetFile, $key);
                        }
                    } else {
                        $sourceFile = $faker->file($fakerDir, storage_path('admix/tmp'));
                        $targetFile = Storage::putFile('tmp', new HttpFile($sourceFile));

                        $category->doUpload($targetFile, $key);
                    }
                }

                $category->save();

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
                'is_active' => 1,
                'name' => $item,
            ]);

            $this->command->getOutput()
                ->progressAdvance();
        });

        $this->command->getOutput()
            ->progressFinish();
    }
}