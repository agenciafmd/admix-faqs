<?php

namespace Agenciafmd\Faqs\Observers;

use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Support\Str;

class FaqObserver
{
    public function saving(Faq $faq): void
    {
        if ($slug = $this->generateSlug($faq)) {
            $faq->slug = $slug;
        }
    }

    private function generateSlug(Faq $faq): ?string
    {
        if ($faq->getRawOriginal('name') === $faq->name) {
            return null;
        }

        $slug = Str::of($faq->name)
            ->trim()
            ->slug();
        $lastSlug = $faq->withTrashed()
            ->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
            ->orderBy('slug', 'desc')
            ->first()?->slug;
        if (!$lastSlug) {
            return $slug;
        }

        $lastSlugId = (int) Str::of($lastSlug)
            ->afterLast('-')
            ->__toString();

        return ($lastSlugId >= 0) ? "{$slug}-" . ($lastSlugId + 1) : $slug;
    }
}
