<?php

namespace Agenciafmd\Faqs\Models;

use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Faq extends Model implements AuditableContract, Searchable
{
    use SoftDeletes, HasFactory, Auditable;

    protected $guarded = [
        //
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public $searchableType;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->searchableType = config('admix-faqs.name');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            "{$this->name}",
            route('admix.faqs.edit', $this->id)
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function category()
    {
        if (config('admix-faqs.category')) {
            return $this->belongsTo(Category::class);
        }

        return null;
    }

    public function getUrlAttribute()
    {
        if (config('admix-faqs.category')) {
            return route('frontend.faqs.show', [
                $this->category->slug, $this->attributes['slug'],
            ]);
        }

        return route('frontend.faqs.show', [
            $this->attributes['slug'],
        ]);
    }

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', Carbon::now());
            });
    }

    public function setPublishedAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public function scopeSort($query)
    {
        $sorts = default_sort(config('admix-faqs.default_sort'));

        foreach ($sorts as $sort) {
            $query->orderBy($sort['field'], $sort['direction']);
        }
    }

    protected static function newFactory()
    {
        return FaqFactory::new();
    }
}
