<?php

namespace Agenciafmd\Faqs;

use Agenciafmd\Categories\Category as CategoryBase;
use Illuminate\Database\Eloquent\Builder;

class Category extends CategoryBase
{
    protected $table = 'categories';

    protected $attributes = [
        'type' => 'faqs-categories',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'faqs-categories');
        });
    }

    public function getUrlAttribute()
    {
        return route('frontend.faqs.index', [
            $this->attributes['slug'],
        ]);
    }
}
