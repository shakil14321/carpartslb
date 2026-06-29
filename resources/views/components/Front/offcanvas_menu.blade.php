<div class="offcanvas__header">
    <div class="offcanvas__inner">
        <div class="offcanvas__logo">
            <a class="offcanvas__logo_link" href="{{ route('home') }}">
                <img src="{{ asset('assets/front/img/logo/car-part-lb.jpg') }}" alt="Grocee Logo" width="158"
                    height="36">
            </a>
            <button class="offcanvas__close--btn" data-offcanvas>close</button>
        </div>
        <nav class="offcanvas__menu">
            <ul class="offcanvas__menu_ul">
                @php
                    $setting = \App\Models\SiteSetting::first();
                @endphp
                @if ($setting && !empty($setting->menu_items))
                    @foreach ($setting->menu_items as $menu)
                        <li class="offcanvas__menu_li">
                            @php
                                $routeName = $menu['name'];
                            @endphp
                            <a class="offcanvas__menu_item" href="{{ $menu['link'] }}">{{ $menu['name'] }}</a>
                        </li>
                    @endforeach
                @else
                    <p class="text-white">Menu items not found.</p>
                @endif
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="javascript:void(0)">Browse By Part Brands</a>
                    <ul class="offcanvas__sub_menu">
                        @php
                            $setting = \App\Models\SiteSetting::first();
                            $carBrandQuantity = $setting ? $setting->brand_quantity : 0;
                            $carPartBrands = \App\Models\CarPartBrand::take($carBrandQuantity)->get();
                        @endphp

                        @if ($carPartBrands->count() > 0)
                            @foreach ($carPartBrands as $carPartBrand)
                                <li class="offcanvas__sub_menu_li"><a
                                        href="{{ route('partBrand.view', $carPartBrand->slug) }}"
                                        class="offcanvas__sub_menu_item">{{ $carPartBrand->title }}</a></li>
                            @endforeach
                        @else
                            <p class="product__card--title text-white">Car brands not found.</p>
                        @endif
                    </ul>
                </li>
            </ul>
            <div class="offcanvas__account--items">
                <a class="offcanvas__account--items__btn d-flex align-items-center"
                    href="{{ Auth::check() && Auth::user()->role === 'customer' ? route('customerDashboard') : route('login.form') }}">
                    <span class="offcanvas__account--items__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.51" height="19.443" viewBox="0 0 512 512">
                            <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                            <path
                                d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                        </svg>
                    </span>
                    <span
                        class="offcanvas__account--items__label">{{ Auth::check() && Auth::user()->role === 'customer' ? ucwords(Auth::user()->name) : 'Login / Register' }}</span>
                </a>
            </div>
        </nav>
    </div>
</div>
