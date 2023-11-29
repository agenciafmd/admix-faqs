<?php

use Agenciafmd\Faqs\Http\Livewire\Pages\Faq\Form;
use Agenciafmd\Faqs\Http\Livewire\Pages\Faq\Index;
use Agenciafmd\Faqs\Models\Faq;
use Livewire\Livewire;

it('can render index route of faqs', function () {
    asAdmix()
        ->get(route('admix.faqs.index'))
        ->assertOk();
});

it('can see item on index route of faqs', function () {
    $model = create(Faq::class);

    asAdmix()
        ->get(route('admix.faqs.index'))
        ->assertOk()
        ->assertSee($model->name);
});

it('can render create route of faqs', function () {
    asAdmix()
        ->get(route('admix.faqs.create'))
        ->assertOk();
});

it('can insert item on create route of faqs', function () {
    asAdmix();
    $model = make(Faq::class);

    Livewire::test(Form::class)
        ->set('model.is_active', $model->is_active)
        ->set('model.name', $model->name)
        ->set('model.description', $model->description)
        ->set('model.sort', $model->sort)
        ->call('submit');

    test()->assertDatabaseHas(table(Faq::class), [
        'name' => $model->name,
    ]);
});

it('can render and see a item on edit route of faqs', function () {
    $model = create(Faq::class);

    asAdmix()
        ->get(route('admix.faqs.edit', $model))
        ->assertOk()
        ->assertSee($model->name);
});

it('can edit item on edit route of faqs', function () {
    asAdmix();
    $model = create(Faq::class);

    Livewire::test(Form::class, ['faq' => $model->id])
        ->set('model.name', $model->name . ' - edited')
        ->call('submit');

    test()->assertDatabaseHas(table(Faq::class), [
        'name' => $model->name . ' - edited',
    ]);
});

it('can delete item on index route of faqs', function () {
    asAdmix();
    $model = create(Faq::class);

    Livewire::test(Index::class)
        ->call('bulkDelete', $model->id);

    test()->assertSoftDeleted(table(Faq::class), [
        'id' => $model->id,
    ]);
});

it('can render and see a item on trash route of faqs', function () {
    $model = create(Faq::class);
    $model->delete();

    asAdmix()
        ->get(route('admix.faqs.trash'))
        ->assertOk()
        ->assertSee($model->name);
});

it('can restore item on trash route of faqs', function () {
    asAdmix();

    $model = create(Faq::class);
    $model->delete();

    Livewire::test(Index::class)
        ->set('isTrash', true)
        ->call('bulkRestore', $model->id);

    test()->assertDatabaseHas(table(Faq::class), [
        'id' => $model->id,
        'deleted_at' => null,
    ]);
});