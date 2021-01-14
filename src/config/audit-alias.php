<?php

return [
    'Agenciafmd\Faqs\Models\Faq' => config('admix-faqs.category') ? config('admix-faqs.name') . ' » ' . config('admix-faqs.name') : config('admix-faqs.name'),
    'Agenciafmd\Faqs\Models\Category' => config('admix-faqs.category') ? config('admix-faqs.name') . ' » ' . config('admix-categories.faqs-categories.name') : config('admix-categories.faqs-categories.name'),
];
