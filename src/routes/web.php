<?php

/*
|--------------------------------------------------------------------------
| ADMIX Routes
|--------------------------------------------------------------------------
*/

if (config('admix-faqs.category')) {
    Route::prefix(config('admix.url') . '/faqs/categories')
        ->name('admix.faqs.categories.')
        ->middleware(['auth:admix-web'])
        ->group(function () {
            Route::get('', '\Agenciafmd\Categories\Http\Controllers\CategoryController@index')
                ->name('index')
                ->middleware('can:view,\Agenciafmd\Faqs\Category');
            Route::get('trash', '\Agenciafmd\Categories\Http\Controllers\CategoryController@index')
                ->name('trash')
                ->middleware('can:restore,\Agenciafmd\Faqs\Category');
            Route::get('create', '\Agenciafmd\Categories\Http\Controllers\CategoryController@create')
                ->name('create')
                ->middleware('can:create,\Agenciafmd\Faqs\Category');
            Route::post('', '\Agenciafmd\Categories\Http\Controllers\CategoryController@store')
                ->name('store')
                ->middleware('can:create,\Agenciafmd\Faqs\Category');
            Route::get('{category}', '\Agenciafmd\Categories\Http\Controllers\CategoryController@show')
                ->name('show')
                ->middleware('can:view,\Agenciafmd\Faqs\Category');
            Route::get('{category}/edit', '\Agenciafmd\Categories\Http\Controllers\CategoryController@edit')
                ->name('edit')
                ->middleware('can:update,\Agenciafmd\Faqs\Category');
            Route::put('{category}', '\Agenciafmd\Categories\Http\Controllers\CategoryController@update')
                ->name('update')
                ->middleware('can:update,\Agenciafmd\Faqs\Category');
            Route::delete('destroy/{category}', '\Agenciafmd\Categories\Http\Controllers\CategoryController@destroy')
                ->name('destroy')
                ->middleware('can:delete,\Agenciafmd\Faqs\Category');
            Route::post('{id}/restore', '\Agenciafmd\Categories\Http\Controllers\CategoryController@restore')
                ->name('restore')
                ->middleware('can:restore,\Agenciafmd\Faqs\Category');
            Route::post('batchDestroy', '\Agenciafmd\Categories\Http\Controllers\CategoryController@batchDestroy')
                ->name('batchDestroy')
                ->middleware('can:delete,\Agenciafmd\Faqs\Category');
            Route::post('batchRestore', '\Agenciafmd\Categories\Http\Controllers\CategoryController@batchRestore')
                ->name('batchRestore')
                ->middleware('can:restore,\Agenciafmd\Faqs\Category');
        });
}

Route::prefix(config('admix.url') . '/faqs')
    ->name('admix.faqs.')
    ->middleware(['auth:admix-web'])
    ->group(function () {
        Route::get('', 'FaqController@index')
            ->name('index')
            ->middleware('can:view,\Agenciafmd\Faqs\Faq');
        Route::get('trash', 'FaqController@index')
            ->name('trash')
            ->middleware('can:restore,\Agenciafmd\Faqs\Faq');
        Route::get('create', 'FaqController@create')
            ->name('create')
            ->middleware('can:create,\Agenciafmd\Faqs\Faq');
        Route::post('', 'FaqController@store')
            ->name('store')
            ->middleware('can:create,\Agenciafmd\Faqs\Faq');
        Route::get('{faq}', 'FaqController@show')
            ->name('show')
            ->middleware('can:view,\Agenciafmd\Faqs\Faq');
        Route::get('{faq}/edit', 'FaqController@edit')
            ->name('edit')
            ->middleware('can:update,\Agenciafmd\Faqs\Faq');
        Route::put('{faq}', 'FaqController@update')
            ->name('update')
            ->middleware('can:update,\Agenciafmd\Faqs\Faq');
        Route::delete('destroy/{faq}', 'FaqController@destroy')
            ->name('destroy')
            ->middleware('can:delete,\Agenciafmd\Faqs\Faq');
        Route::post('{id}/restore', 'FaqController@restore')
            ->name('restore')
            ->middleware('can:restore,\Agenciafmd\Faqs\Faq');
        Route::post('batchDestroy', 'FaqController@batchDestroy')
            ->name('batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Faqs\Faq');
        Route::post('batchRestore', 'FaqController@batchRestore')
            ->name('batchRestore')
            ->middleware('can:restore,\Agenciafmd\Faqs\Faq');
    });
