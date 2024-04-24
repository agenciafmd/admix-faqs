<?php

namespace Agenciafmd\Faqs\Livewire\Pages\Faq;

use Agenciafmd\Faqs\Models\Faq;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;

class Component extends LivewireComponent
{
    use AuthorizesRequests;

    public Form $form;

    public Faq $faq;

    public function mount(Faq $faq): void
    {
        ($faq->exists) ? $this->authorize('update', Faq::class) : $this->authorize('create', Faq::class);

        $this->faq = $faq;
        $this->form->setModel($faq);
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->faq->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.faqs.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix-faqs::pages.faq.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
