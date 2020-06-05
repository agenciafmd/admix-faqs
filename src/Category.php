<?php

namespace Agenciafmd\Faqs;

use Agenciafmd\Categories\Category as CategoryBase;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends CategoryBase implements Searchable
{
    protected $table = 'categories';

    protected $attributes = [
        'type' => 'faqs-categories',
    ];

    public $searchableType;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->searchableType = config('admix-categories.faqs-categories.name');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            "{$this->name} ({$this->email})",
            route('admix.faqs.categories.edit', $this->id)
        );
    }

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
