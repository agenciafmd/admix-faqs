<?php

namespace Agenciafmd\Faqs\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Faqs\Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Faq extends Model implements AuditableContract
{
    use Auditable, HasFactory, SoftDeletes, WithScopes;

    protected $guarded = [
        //
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected array $defaultSort = [
        'is_active' => 'desc',
        'sort' => 'asc',
        'name' => 'asc',
    ];

    protected static function newFactory(): FaqFactory
    {
        if (class_exists(\Database\Factories\FaqFactory::class)) {
            return \Database\Factories\FaqFactory::new();
        }

        return FaqFactory::new();
    }
}
