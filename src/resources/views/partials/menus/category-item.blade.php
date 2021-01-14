@can('view', [
    \Agenciafmd\Faqs\Models\Category::class,
    \Agenciafmd\Faqs\Models\Faq::class,
])
    <li class="nav-item">
        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.faqs')) ? 'active' : '' }}"
           href="#sidebar-faqs" data-toggle="collapse" data-parent="#menu" role="button"
           aria-expanded="{{ (Str::startsWith(request()->route()->getName(), 'admix.faqs')) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon {{ config('admix-faqs.icon') }}"></i>
            </span>
            <span class="nav-text">
                {{ config('admix-faqs.name') }}
            </span>
        </a>
        <div class="navbar-subnav collapse {{ (Str::startsWith(request()->route()->getName(), 'admix.faqs')) ? 'show' : '' }}"
             id="sidebar-faqs">
            <ul class="nav">
                @can('view', \Agenciafmd\Faqs\Models\Category::class)
                    <li class="nav-item">
                        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.faqs.categories')) ? 'active' : '' }}"
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
                @can('view', \Agenciafmd\Faqs\Models\Faq::class)
                    <li class="nav-item">
                        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.faqs') && !Str::startsWith(request()->route()->getName(), 'admix.faqs.categories')) ? 'active' : '' }}"
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
