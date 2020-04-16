@extends('agenciafmd/admix::partials.crud.form')

@section('form')
    {{ Form::bsOpen(['model' => optional($model), 'create' => route('admix.faqs.store'), 'update' => route('admix.faqs.update', ['faq' => ($model->id) ?? 0])]) }}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">
            @if(request()->is('*/create'))
                Criar
            @elseif(request()->is('*/edit'))
                Editar
            @else
                Visualizar
            @endif
            {{ config('admix-faqs.name') }}
        </h3>
        <div class="card-options">
            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    <ul class="list-group list-group-flush">

        @if (optional($model)->id)
            {{ Form::bsText('Código', 'id', null, ['disabled' => true]) }}
        @endif

        {{ Form::bsIsActive('Ativo', 'is_active', null, ['required']) }}

        {{ Form::bsBoolean('Destaque', 'star', null, ['required']) }}

        @if(config('admix-faqs.category'))
            @include('agenciafmd/categories::partials.form.select', [
                'label' => config('admix-categories.faqs-categories.name'),
                'name' => 'category_id',
                'type' => 'faqs-categories',
                'required' => true
            ])
        @endif

        {{ Form::bsText('Nome', 'name', null, ['required']) }}

        @if(config('admix-faqs.call'))
            {{ Form::bsText('Chamada', 'call', null) }}
        @endif

        @if(config('admix-faqs.short_description'))
            @if(config('admix-faqs.wysiwyg'))
                {{ Form::bsTextarea('Resumo', 'short_description', null) }}
            @else
                {{ Form::bsTextareaPlain('Resumo', 'short_description', null) }}
            @endif
        @endif

        @if(config('admix-faqs.wysiwyg'))
            {{ Form::bsTextarea('Descrição', 'description', null) }}
        @else
            {{ Form::bsTextareaPlain('Descrição', 'description', null) }}
        @endif

        @if(config('admix-faqs.published_at'))
            {{ Form::bsDateTime('Data de Publicação', 'published_at', optional(optional($model)->published_at)->format("Y-m-d\TH:i"), ['required']) }}
        @endif

    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    {{ Form::close() }}
@endsection
