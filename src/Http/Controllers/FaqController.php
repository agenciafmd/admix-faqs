<?php

namespace Agenciafmd\Faqs\Http\Controllers;

use Agenciafmd\Faqs\Faq;
use Agenciafmd\Faqs\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $query = QueryBuilder::for(Faq::class)
            ->defaultSorts(config('admix-faqs.default_sort'))
            ->allowedSorts($request->sort)
            ->allowedFilters((($request->filter) ? array_keys($request->get('filter')) : []));

        if ($request->is('*/trash')) {
            $query->onlyTrashed();
        }

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/faqs::index', $view);
    }

    public function create(Faq $faq)
    {
        $view['model'] = $faq;

        return view('agenciafmd/faqs::form', $view);
    }

    public function store(FaqRequest $request)
    {
        if ($faq = Faq::create($request->validated())) {
            flash('Item inserido com sucesso.', 'success');
        } else {
            flash('Falha no cadastro.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }

    public function show(Faq $faq)
    {
        $view['model'] = $faq;

        return view('agenciafmd/faqs::form', $view);
    }

    public function edit(Faq $faq)
    {
        $view['model'] = $faq;

        return view('agenciafmd/faqs::form', $view);
    }

    public function update(Faq $faq, FaqRequest $request)
    {
        if ($faq->update($request->validated())) {
            flash('Item atualizado com sucesso.', 'success');
        } else {
            flash('Falha na atualização.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }

    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }

    public function restore($id)
    {
        $faq = Faq::onlyTrashed()
            ->find($id);

        if (!$faq) {
            flash('Item já restaurado.', 'danger');
        } elseif ($faq->restore()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }

    public function batchDestroy(Request $request)
    {
        if (Faq::destroy($request->get('id', []))) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }

    public function batchRestore(Request $request)
    {
        $faq = Faq::onlyTrashed()
            ->whereIn('id', $request->get('id', []))
            ->restore();

        if ($faq) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.faqs.index');
    }
}
