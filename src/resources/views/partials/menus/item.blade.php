@can('view', '\Agenciafmd\Faqs\Faq')
    <li class="nav-item">
        <a class="nav-link {{ (admix_is_active(route('admix.faqs.index'))) ? 'active' : '' }}"
           href="{{ route('admix.faqs.index') }}"
           aria-expanded="{{ (admix_is_active(route('admix.faqs.index'))) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon {{ config('admix-faqs.icon') }}"></i>
        </span>
            <span class="nav-text">
            {{ config('admix-faqs.name') }}
        </span>
        </a>
    </li>
@endcan
