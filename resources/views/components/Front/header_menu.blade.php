@php
    $setting = \App\Models\SiteSetting::first();
    $categories = \App\Models\CarPartType::orderBy('title')->get();
@endphp

<style>

    .header__bottom{
        padding: 0px !important;
    }

    .all_categories_title{
        height: 45px;
    }

    .header__bottom--inner{
        min-height: 45px;
    }
    .header__bottom--inner {
        gap: 25px;
    }

    .all_categories_menu {
        width: 280px;
        position: relative;
        flex-shrink: 0;
    }

    .all_categories_title {
        background: #ef2020;
        color: #fff;
        height: 55px;
        padding: 0 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
    }

    .category-bars {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .category-bars span {
        width: 30px;
        height: 3px;
        background: #fff;
        display: block;
        border-radius: 2px;
    }

    .all_categories_dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #fff;
        border: 1px solid #eee;
        z-index: 9999;
        padding: 0;
        margin: 0;
        list-style: none;
        box-shadow: 0 8px 20px rgba(0,0,0,.08);
        display: none;
    }

    .all_categories_menu:hover .all_categories_dropdown {
        display: block;
    }

    .all_categories_dropdown li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        color: #111;
        font-size: 15px;
        border-bottom: 1px solid #eee;
        text-decoration: none;
    }

    .all_categories_dropdown li:last-child a {
        border-bottom: none;
    }

    .all_categories_dropdown li a:hover {
        background: #f8f8f8;
        color: #ef2020;
    }

    .header__right--area {
        margin-left: auto;
    }

    .header__menu--wrapper {
        gap: 25px;
    }

    .header__menu--link,
    .header__menu--link.active,
    .header__menu--link:hover,
    .header__menu--items.active .header__menu--link {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        background: transparent !important;
        border-radius: 0 !important;
        padding: 0 !important;
    }

    .header__menu--link::before,
    .header__menu--link::after,
    .header__menu--items::before,
    .header__menu--items::after {
        display: none !important;
        content: none !important;
    }
</style>

<div class="header__bottom bg__primary py-5">
    <div class="container">
        <div class="header__bottom--inner position__relative d-flex align-items-center">

            <div class="all_categories_menu">
                <div class="all_categories_title">
                    <span>All Categories</span>

                    <span class="category-bars">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>

                <ul class="all_categories_dropdown">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('type.view', $category->slug) }}">
                                {{ $category->title }}
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="header__right--area d-flex justify-content-end align-items-center">
                <div class="header__menu">
                    <nav class="header__menu--navigation">
                        <ul class="header__menu--wrapper d-flex align-items-center">
                            @if($setting && !empty($setting->menu_items))
                                @foreach($setting->menu_items as $menu)
                                    @php
                                        $routeName = strtolower($menu['name']);
                                    @endphp

                                    <li class="header__menu--items">
                                        <a href="{{ $menu['link'] }}"
                                           class="header__menu--link text-white {{ request()->routeIs($routeName) ? 'active' : '' }}">
                                            {{ $menu['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="header__menu--items">
                                    <span class="text-white">Menu items not found.</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
