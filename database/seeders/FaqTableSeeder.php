<?php

namespace Agenciafmd\Faqs\Database\Seeders;

use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    protected int $total = 100;

    public function run(): void
    {
        Faq::query()
            ->truncate();

        $this->command->getOutput()
            ->progressStart($this->total);

        collect(range(1, $this->total))
            ->each(function () {
                Faq::factory()
                    ->create();

                $this->command->getOutput()
                    ->progressAdvance();
            });

        $this->command->getOutput()
            ->progressFinish();
    }
}
