<?php

namespace Agenciafmd\Faqs\Livewire\Pages\Faq;

use Agenciafmd\Faqs\Models\Faq;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public Faq $faq;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public string $name = '';

    #[Validate]
    public ?string $description = null;

    #[Validate]
    public ?int $sort = null;

    public function setModel(Faq $faq): void
    {
        $this->faq = $faq;
        if ($faq->exists) {
            $this->is_active = $faq->is_active;
            $this->name = $faq->name;
            $this->description = $faq->description;
            $this->sort = $faq->sort;
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'boolean',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'description' => [
                'nullable',
            ],
            'sort' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }

    public function prepareForValidation($attributes): array
    {
        $this->sort = $attributes['sort'] = ($attributes['sort']) ? (int) $attributes['sort'] : null;

        return $attributes;
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('local-faqs::fields.is_active'),
            'name' => __('local-faqs::fields.name'),
            'description' => __('local-faqs::fields.description'),
            'sort' => __('local-faqs::fields.sort'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->faq->fill($this->except('faq'));

        return $this->faq->save();
    }
}
