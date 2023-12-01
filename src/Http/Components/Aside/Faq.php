<?php

namespace Agenciafmd\Faqs\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Faq extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public string $url = '',
        public bool $active = false,
        public bool $visible = false,
    )
    {
    }

    public function render(): View
    {
        $this->icon = __(config('admix-faqs.icon'));
        $this->label = __(config('admix-faqs.name'));
        $this->url = route('admix.faqs.index');
        $this->active = request()?->currentRouteNameStartsWith('admix.faqs');
        $this->visible = true;

        return view('admix::components.aside.item');
    }
}