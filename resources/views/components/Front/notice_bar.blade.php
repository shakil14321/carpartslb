@php
    $setting = \App\Models\SiteSetting::first();
@endphp
<div class="header__topbar border-bottom">
    <div class="container">
        <div class="header__topbar--inner custom-gap-mobile">
            <ul class="header__topbar--info">
                <li class="header__info--list notic_content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                        stroke="#ed1d24" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-package-check-icon lucide-package-check">
                        <path d="m16 16 2 2 4-4" />
                        <path
                            d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                        <path d="m7.5 4.27 9 5.15" />
                        <polyline points="3.29 7 12 12 20.71 7" />
                        <line x1="12" x2="12" y1="22" y2="12" />
                    </svg>
                    <p>{{ $setting && $setting->shipping_text ? $setting->shipping_text : 'Shipping 6 Days/Week' }}</span>
                    </p>
                    {{-- <p>Shipping 6 <span class="break">Days/Week</span></p> --}}
                </li>
            </ul>
            <div class="header__top--right d-flex align-items-center">
                <ul class="header__topbar--info">
                    <li class="header__info--list notic_content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="#ed1d24" stroke-width="1.3" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        {{-- <p>Price Match <span class="break">Guarantee</span></p> --}}
                        <p>{{ $setting && $setting->price_guarantee_text ? $setting->price_guarantee_text : 'Price Match Guarantee' }}</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
