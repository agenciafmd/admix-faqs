<?php

namespace Agenciafmd\Faqs\Models;

use Agenciafmd\Categories\Models\Category as CategoryBase;
use Agenciafmd\Faqs\Database\Factories\FaqCategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends CategoryBase implements Searchable
{
    use HasFactory;

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

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'faqs-categories');
        });
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            "{$this->name}",
            route('admix.faqs.categories.edit', $this->id)
        );
    }

    public function getUrlAttribute()
    {
        return route('frontend.faqs.index', [
            $this->attributes['slug'],
        ]);
    }

    public function scopeSort($query, $type = 'faqs-categories'): void
    {
        parent::scopeSort($query, $type);
    }

    protected static function newFactory()
    {
        if (class_exists(\Database\Factories\FaqCategoryFactory::class)) {
            return \Database\Factories\FaqCategoryFactory::new();
        }

        return FaqCategoryFactory::new();
    }
}
