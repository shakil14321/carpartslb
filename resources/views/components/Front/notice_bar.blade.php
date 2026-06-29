@php
    $setting = \App\Models\SiteSetting::first();
@endphp

<div class="header__topbar border-bottom">
    <div class="container">
        <div class="header__topbar--inner custom-gap-mobile d-flex justify-content-between align-items-center">

            <ul class="header__topbar--info topbar-left-info d-flex align-items-center flex-wrap">


                <li class="header__info--list notic_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="#ed1d24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                    <p>admin@gmail.com</p>
                </li>

                <li class="header__info--list notic_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="#ed1d24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.47-1.12a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <p>+88 017 82 524 248</p>
                </li>

                <li class="header__info--list notic_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                         stroke="#ed1d24" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m16 16 2 2 4-4" />
                        <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                        <path d="m7.5 4.27 9 5.15" />
                        <polyline points="3.29 7 12 12 20.71 7" />
                        <line x1="12" x2="12" y1="22" y2="12" />
                    </svg>
                    <p>{{ $setting && $setting->shipping_text ? $setting->shipping_text : 'Shipping 6 Days/Week' }}</p>
                </li>
            </ul>

            <div class="header__top--right d-flex align-items-center">
                <ul class="header__topbar--info d-flex align-items-center">
                    <li class="header__info--list notic_content d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                             fill="none" stroke="#ed1d24" stroke-width="1.3" stroke-linecap="round"
                             stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        <p>{{ $setting && $setting->price_guarantee_text ? $setting->price_guarantee_text : 'Price Match Guarantee' }}</p>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<style>
    .topbar-left-info {
        gap: 22px;
    }

    .header__info--list {
        gap: 8px;
    }

    .header__info--list p {
        margin: 0;
        white-space: nowrap;
    }

    @media (max-width: 767px) {
        .header__topbar--inner {
            gap: 10px;
        }

        .topbar-left-info {
            gap: 12px;
        }
    }
</style>
