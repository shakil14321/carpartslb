<div class="header__bottom bg__primary py-3">
    <div class="container">
        <div class="header__bottom--inner position__relative d-flex align-items-center">
            <div class="header__right--area d-flex justify-content-between align-items-center">
                <div class="header__menu">
                    <nav class="header__menu--navigation">
                        <ul class="header__menu--wrapper d-flex">
                             @php
                                $setting = \App\Models\SiteSetting::first();
                            @endphp
                            @if($setting && !empty($setting->menu_items))
                                @foreach($setting->menu_items as $menu)
                                    <li class="header__menu--items">
                                        @php
                                            $routeName = $menu['name'];
                                        @endphp
                                        <a href="{{ $menu['link'] }}" class="header__menu--link text-white {{ request()->routeIs(strtolower($routeName)) ? 'active' : '' }}">{{ $menu['name'] }}</a>
                                    </li>
                                @endforeach
                                
                            @else
                            <p class="text-white">Menu items not found.</p>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>