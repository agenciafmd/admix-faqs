@can('view', \Agenciafmd\Faqs\Models\Faq::class)
    <li class="nav-item">
        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.faqs')) ? 'active' : '' }}"
           href="{{ route('admix.faqs.index') }}"
           aria-expanded="{{ (Str::startsWith(request()->route()->getName(), 'admix.faqs')) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon {{ config('admix-faqs.icon') }}"></i>
        </span>
            <span class="nav-text">
            {{ config('admix-faqs.name') }}
        </span>
        </a>
    </li>
@endcan
