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

        $i = 1;
        $uniqueSlug = $slug;
        while ($faq->withoutGlobalScopes()
            ->where('slug', $uniqueSlug)
            ->orderBy('slug')
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
