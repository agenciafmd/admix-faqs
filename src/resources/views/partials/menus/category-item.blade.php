@if (!((admix_cannot('view', '\Agenciafmd\Faqs\Faq')) && (admix_cannot('view', '\Agenciafmd\Faqs\Category'))))
    <li class="nav-item">
        <a class="nav-link @if (admix_is_active(route('admix.faqs.index')) || admix_is_active(route('admix.faqs.categories.index'))) active @endif"
           href="#sidebar-faqs" data-toggle="collapse" data-parent="#menu" role="button"
           aria-expanded="{{ (admix_is_active(route('admix.faqs.index')) || admix_is_active(route('admix.faqs.categories.index'))) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon {{ config('admix-faqs.icon') }}"></i>
            </span>
            <span class="nav-text">
                {{ config('admix-faqs.name') }}
            </span>
        </a>
        <div
            class="navbar-subnav collapse @if (admix_is_active(route('admix.faqs.index')) || admix_is_active(route('admix.faqs.categories.index')) ) show @endif"
            id="sidebar-faqs">
            <ul class="nav">
                @can('view', '\Agenciafmd\Faqs\Category')
                    <li class="nav-item">
                        <a class="nav-link {{ admix_is_active(route('admix.faqs.categories.index')) ? 'active' : '' }}"
                           href="{{ route('admix.faqs.categories.index') }}">
                            <span class="nav-icon">
                                <i class="icon fe-minus"></i>
                            </span>
                            <span class="nav-text">
                                {{ config('admix-categories.faqs-categories.name') }}
                            </span>
                        </a>
                    </li>
                @endcan
                @can('view', '\Agenciafmd\Faqs\Faq')
                    <li class="nav-item">
                        <a class="nav-link {{ admix_is_active(route('admix.faqs.index')) ? 'active' : '' }}"
                           href="{{ route('admix.faqs.index') }}">
                            <span class="nav-icon">
                                <i class="icon fe-minus"></i>
                            </span>
                            <span class="nav-text">
                                {{ config('admix-faqs.name') }}
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endif
