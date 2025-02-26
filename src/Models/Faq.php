<?php

namespace Agenciafmd\Faqs\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Admix\Traits\WithSlug;
use Agenciafmd\Faqs\Database\Factories\FaqFactory;
use Agenciafmd\Faqs\Observers\FaqObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

#[ObservedBy([FaqObserver::class])]
class Faq extends Model implements AuditableContract
{
    use Auditable, HasFactory, Prunable, SoftDeletes, WithScopes, WithSlug;

    protected array $defaultSort = [
        'is_active' => 'desc',
        'sort' => 'asc',
        'name' => 'asc',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function prunable(): Builder
    {
        return self::where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): FaqFactory
    {
        if (class_exists(\Database\Factories\FaqFactory::class)) {
            return \Database\Factories\FaqFactory::new();
        }

        return FaqFactory::new();
    }
}
