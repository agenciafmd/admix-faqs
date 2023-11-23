<?php

namespace Agenciafmd\Faqs\Http\Livewire\Pages\Faq;

use Agenciafmd\Admix\Http\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Faqs\Models\Faq;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Index extends BaseIndex
{
    protected $model = Faq::class;
    protected string $indexRoute = 'admix.faqs.index';
    protected string $trashRoute = 'admix.faqs.trash';
    protected string $creteRoute = 'admix.faqs.create';
    protected string $editRoute = 'admix.faqs.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix-faqs.name'));

        parent::configure();
    }


    public function columns(): array
    {
        $this->setAdditionalColumns([
            Column::make(__('admix-faqs::fields.sort'), 'sort')
                ->sortable(),
        ]);

        return parent::columns();
    }
}