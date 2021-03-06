<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        @if (
            $logged_in_user->isAdmin() ||
            (
                $logged_in_user->can('access.user.list') ||
                $logged_in_user->can('access.user.deactivate') ||
                $logged_in_user->can('access.user.reactivate') ||
                $logged_in_user->can('access.user.clear-session') ||
                $logged_in_user->can('access.user.impersonate') ||
                $logged_in_user->can('access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->isAdmin() ||
                        (
                            $logged_in_user->can('access.user.list') ||
                            $logged_in_user->can('access.user.deactivate') ||
                            $logged_in_user->can('access.user.reactivate') ||
                            $logged_in_user->can('access.user.clear-session') ||
                            $logged_in_user->can('access.user.impersonate') ||
                            $logged_in_user->can('access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->isAdmin())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

{{--        shops nav item--}}
        <li class="c-sidebar-nav-title">@lang('Shops Management')</li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('shops.index')"
                :active="activeClass(Route::is('shops.index'), 'c-active')"
                icon="c-sidebar-nav-icon fas fa-store"
                :text="__('Shops')" />
        </li>

{{--        products nav item--}}
        <li class="c-sidebar-nav-title">@lang('Products Management')</li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('products.index')"
                :active="activeClass(Route::is('products.index'), 'c-active')"
                icon="c-sidebar-nav-icon fas fa-shopping-bag"
                :text="__('Products')" />
        </li>



    </ul>



    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
