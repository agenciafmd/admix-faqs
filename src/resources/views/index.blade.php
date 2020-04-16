@extends('agenciafmd/admix::partials.crud.index', [
    'route' => (request()->is('*/trash') ? route('admix.faqs.trash') : route('admix.faqs.index'))
])

@section('title')
    @if(request()->is('*/trash'))
        Lixeira de
    @endif
    {{ config('admix-faqs.name') }}
@endsection

@section('actions')
    @if(request()->is('*/trash'))
        @include('agenciafmd/admix::partials.btn.back', ['url' => route('admix.faqs.index')])
    @else
        @can('create', '\Agenciafmd\Faqs\Faq')
            @include('agenciafmd/admix::partials.btn.create', ['url' => route('admix.faqs.create'), 'label' => config('admix-faqs.name')])
        @endcan
        @can('restore', '\Agenciafmd\Faqs\Faq')
            @include('agenciafmd/admix::partials.btn.trash', ['url' => route('admix.faqs.trash')])
        @endcan
    @endif
@endsection

@section('batch')
    @if(request()->is('*/trash'))
        @can('restore', '\Agenciafmd\Faqs\Faq')
            {{ Form::select('batch', ['' => 'com os selecionados', route('admix.faqs.batchRestore') => '- restaurar'], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @else
        @can('delete', '\Agenciafmd\Faqs\Faq')
            {{ Form::select('batch', ['' => 'com os selecionados', route('admix.faqs.batchDestroy') => '- remover'], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @endif
@endsection

@section('filters')
    <h6 class="dropdown-header bg-gray-lightest p-2">Destaque</h6>
    <div class="p-2">
        {{ Form::select('filter[star]', [
                '' => '-',
                '1' => 'Sim',
                '0' => 'Não'
            ], filter('star'), [
                'class' => 'form-control form-control-sm'
            ]) }}
    </div>

    @if(config('admix-faqs.category'))
        @include('agenciafmd/categories::partials.form.filter', [
            'label' => config('admix-categories.faqs-categories.name'),
            'name' => 'category_id',
            'type' => 'faqs-categories'
        ])
    @endif
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1 d-none d-md-table-cell">&nbsp;</th>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th>{!! column_sort('Nome', 'name') !!}</th>
                    <th>{!! column_sort('Destaque', 'star') !!}</th>
                    <th>{!! column_sort('Status', 'is_active') !!}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <label class="mb-1 custom-control custom-checkbox">
                                <input type="checkbox" class="js-check custom-control-input"
                                       name="check[]" value="{{ $item->id }}">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </td>
                        <td><span class="text-muted">{{ $item->id }}</span></td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @include('agenciafmd/admix::partials.label.star', ['star' => $item->star])
                        </td>
                        <td>
                            @include('agenciafmd/admix::partials.label.status', ['status' => $item->is_active])
                        </td>
                        @if(request()->is('*/trash'))
                            <td class="w-1 text-right">
                                @include('agenciafmd/admix::partials.btn.restore', ['url' => route('admix.faqs.restore', $item->id)])
                            </td>
                        @else
                            <td class="w-1 text-center">
                                <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="icon">
                                        <i class="icon fe-more-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @include('agenciafmd/admix::partials.btn.show', ['url' => route('admix.faqs.show', $item->id)])
                                        @can('update', '\Agenciafmd\Faqs\Faq')
                                            @include('agenciafmd/admix::partials.btn.edit', ['url' => route('admix.faqs.edit', $item->id)])
                                        @endcan
                                        @can('delete', '\Agenciafmd\Faqs\Faq')
                                            @include('agenciafmd/admix::partials.btn.remove', ['url' => route('admix.faqs.destroy', $item->id)])
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $items->appends(request()->except(['page']))->links() !!}
    @else
        @include('agenciafmd/admix::partials.info.not-found')
    @endif
@endsection
