<?php

namespace Agenciafmd\Faqs\Http\Livewire\Pages\Faq;

use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class Form extends Component
{
    use AuthorizesRequests;

    public Faq $model;

    public function mount(Faq $faq): void
    {
        ($faq->id) ? $this->authorize('update', Faq::class) : $this->authorize('create', Faq::class);

        $this->model = $faq;
        $this->model->is_active ??= false;
    }

    public function rules(): array
    {
        return [
            'model.is_active' => [
                'boolean',
            ],
            'model.name' => [
                'required',
                'max:255',
            ],
            'model.description' => [
                'nullable',
            ],
            'model.sort' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }

    public function prepareForValidation($attributes): array
    {
        $attributes['model']['sort'] = ($attributes['model']['sort']) ? (int) $attributes['model']['sort'] : null;

        return $attributes;
    }

    public function attributes(): array
    {
        return [
            'is_active' => __('admix-faqs::fields.is_active'),
            'name' => __('admix-faqs::fields.name'),
            'description' => __('admix-faqs::fields.description'),
            'sort' => __('admix-faqs::fields.sort'),
        ];
    }

    public function submit(): null|RedirectResponse|Redirector
    {
        $this->validate($this->rules(), [], $this->attributes());

        try {
            if ($this->model->save()) {
                flash(__('crud.success.save'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.faqs.index'));
        } catch (\Exception $exception) {
            $this->emit('toast', [
                'level' => 'danger',
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function render(): View
    {
        return view('admix-faqs::pages.faq.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
