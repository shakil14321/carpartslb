 {{-- @php
     use App\Models\Cart;

     $userId = auth()->id();
     $sessionId = session()->getId();
     //  dump($sessionId);

     $cartItems = Cart::where(function ($q) use ($userId, $sessionId) {
         if ($userId) {
             $q->where('user_id', $userId);
         } else {
             $q->where('session_id', $sessionId);
         }
     })->get();

     $cartCount = $cartItems->count();

     $cartTotal = 0;
     foreach ($cartItems as $item) {
         $price = $item->sale_price ?? ($item->original_price ?? 0);
         $cartTotal += $price * $item->quantity;
     }
     //  $userId = auth()->id();
     //  $cartItems = Cart::where('user_id', $userId)->get();

     //  $cartCount = $cartItems->count();

     //  $cartTotal = 0;
     //  foreach ($cartItems as $item) {
     //      $price = $item->sale_price ?? ($item->original_price ?? 0);
     //      $cartTotal += $price * $item->quantity;
     //  }
 @endphp --}}

 @php
     use App\Models\Product;

     $cart = session()->get('cart', []);

     $cartCount = 0;
     $cartTotal = 0;

     foreach ($cart as $item) {
         $price = $item['sale_price'] ?? ($item['original_price'] ?? 0);
         $cartTotal += $price * $item['quantity'];
         //  $cartCount += $item['quantity'];
     }
     $cartCount = count($cart);
 @endphp

 <div class="main__header header__sticky">
     <div class="container">
         <div class="main__header--inner position__relative d-flex justify-content-between align-items-center px-2">
             <!-- Offcanvas menu startup  -->
             <div class="offcanvas__header--menu__open ">
                 <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                     <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg"
                         viewBox="0 0 512 512">
                         <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                             stroke-width="32" d="M80 160h352M80 256h352M80 352h352" />
                     </svg>
                     <span class="visually-hidden">Offcanvas Menu Open</span>
                 </a>
             </div>
             <!-- End offcanvas menu startup -->
             @php
                 $setting = \App\Models\SiteSetting::first();
             @endphp
             <div class="main__logo">
                 <h1 class="main__logo--title"><a class="main__logo--link" href="{{ route('home') }}"><img
                             class="main__logo--img"
                             src="{{ asset($setting && $setting->site_logo ? 'public/images/logos/' . $setting->site_logo : 'public/images/logos/demo.png') }}"
                             alt="logo-img" width="175px"></a></h1>
             </div>
             {{-- Search input field --}}
             <div class="header__search--widget d-none d-lg-block header__sticky--none">
                 <form class="d-flex header__search--form border-radius-5" action="{{ route('search.page') }}"
                     method="GET">
                     <div class="header__search--box">
                         <label for="search_field">
                             <input id="globalSearch" name="query" class="header__search--input"
                                 placeholder="Search For Products..." type="text" autocomplete="off"
                                 value="{{ request()->query('query') }}">
                         </label>
                         <button class="header__search--button bg__primary text-white" aria-label="search button"
                             type="submit">
                             <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                     fill="currentColor" />
                             </svg>
                         </button>
                         <div id="searchResults" class="search-results" style="display:none;"></div>
                     </div>
                 </form>
             </div>
             {{-- End Search input field --}}
             <div class="header__menu d-none d-lg-block header__sticky--block">
                 <!-- Main menu start -->
                 <nav class="header__menu--navigation">
                     <ul class="header__menu--wrapper d-flex">
                         @if ($setting && !empty($setting->menu_items))
                             @foreach ($setting->menu_items as $menu)
                                 <li class="header__menu--items">
                                     @php
                                         $routeName = $menu['name'];
                                     @endphp
                                     <a href="{{ $menu['link'] }}"
                                         class="header__menu--link {{ request()->routeIs(strtolower($routeName)) ? 'active' : '' }}">{{ $menu['name'] }}</a>
                                 </li>
                             @endforeach
                         @else
                             <p>Menu items not found.</p>
                         @endif
                     </ul>
                 </nav>
                 <!-- End main menu -->
             </div>
             <!-- Sticky header menu -->
             <div class="header__account header__sticky--none">
                 <ul class="header__account--wrapper d-flex align-items-center">
                     <li class="header__account--items d-none d-lg-block">
                         <a class="header__account--btn"
                             href="{{ Auth::check() && Auth::user()->role === 'customer' ? route('customerDashboard') : route('login.form') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class=" -user">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                             </svg>
                             <span class="visually-hidden">My account</span>
                         </a>
                     </li>
                     <li class="header__account--items  header__account--search__items mobile__d--block d-sm-2-none">
                         <a class="header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                             <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                 width="22.51" height="20.443" viewBox="0 0 512 512">
                                 <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                     fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                 <path fill="none" stroke="currentColor" stroke-linecap="round"
                                     stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                             </svg>
                             <span class="visually-hidden">Search</span>
                         </a>
                     </li>

                     <li class="header__account--items header__minicart--items">
                         <a class="header__account--btn minicart__open--btn" href="javascript:void(0)" data-offcanvas>
                             <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534"
                                 viewBox="0 0 14.706 13.534">
                                 <g transform="translate(0 0)">
                                     <g>
                                         <path data-name="Path 16787"
                                             d="M4.738,472.271h7.814a.434.434,0,0,0,.414-.328l1.723-6.316a.466.466,0,0,0-.071-.4.424.424,0,0,0-.344-.179H3.745L3.437,463.6a.435.435,0,0,0-.421-.353H.431a.451.451,0,0,0,0,.9h2.24c.054.257,1.474,6.946,1.555,7.33a1.36,1.36,0,0,0-.779,1.242,1.326,1.326,0,0,0,1.293,1.354h7.812a.452.452,0,0,0,0-.9H4.74a.451.451,0,0,1,0-.9Zm8.966-6.317-1.477,5.414H5.085l-1.149-5.414Z"
                                             transform="translate(0 -463.248)" fill="currentColor" />
                                         <path data-name="Path 16788"
                                             d="M5.5,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,5.5,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,6.793,478.352Z"
                                             transform="translate(-1.191 -466.622)" fill="currentColor" />
                                         <path data-name="Path 16789"
                                             d="M13.273,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,13.273,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,14.566,478.352Z"
                                             transform="translate(-2.875 -466.622)" fill="currentColor" />
                                     </g>
                                 </g>
                             </svg>
                             <span class="items__count">{{ $cartCount }}</span>

                             <div id="cart-price"></div>
                             <span class="minicart__btn--text">My Cart <br>
                                 <span class="minicart__btn--text__price">
                                     {{ '$' . number_format($cartTotal, 2) }}
                                 </span>
                             </span>
                             {{-- <span class="items__count">{{ count(session('cart', [])) }}</span>
                             <span class="minicart__btn--text">My Cart <br>
                                 <span class="minicart__btn--text__price" id="header_cart_total">
                                     @php
                                         $total = 0;
                                         foreach (session('cart', []) as $item) {
                                             $price = $item['sale_price'] ?: $item['original_price'];
                                             $total += $price * $item['quantity'];
                                         }
                                         echo '$' . number_format($total, 2);
                                     @endphp
                                 </span>
                             </span> --}}
                         </a>
                     </li>
                 </ul>
             </div>
             {{-- Sticky mobile header --}}
             <div class="header__account header__sticky--block">
                 <ul class="header__account--wrapper d-flex align-items-center">
                     <li class="header__account--items  header__account--search__items d-sm-2-none">
                         <a class="header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                             <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                 width="22.51" height="20.443" viewBox="0 0 512 512">
                                 <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                     fill="none" stroke="currentColor" stroke-miterlimit="10"
                                     stroke-width="32" />
                                 <path fill="none" stroke="currentColor" stroke-linecap="round"
                                     stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                             </svg>
                             <span class="visually-hidden">Search</span>
                         </a>
                     </li>
                     <li class="header__account--items d-none d-lg-block">
                         <a class="header__account--btn"
                             href="{{ Auth::check() && Auth::user()->role === 'customer' ? route('customerDashboard') : route('login.form') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class=" -user">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                             </svg>
                             <span class="visually-hidden">My account</span>
                         </a>
                     </li>

                     {{-- Mobile search icon --}}
                     <li class="header__account--items header__minicart--items custom_mobile_icon">
                         <a class="offcanvas__stikcy--toolbar__btn search__open--btn" href="javascript:void(0)"
                             data-offcanvas>
                             <span class="offcanvas__stikcy--toolbar__icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                     viewBox="0 0 512 512">
                                     <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                         fill="none" stroke="currentColor" stroke-miterlimit="10"
                                         stroke-width="32" />
                                     <path fill="none" stroke="currentColor" stroke-linecap="round"
                                         stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                 </svg>
                             </span>
                             <span class="offcanvas__stikcy--toolbar__label visually-hidden">Search</span>
                         </a>
                     </li>
                     {{-- End mobile search icon --}}

                     <li class="header__account--items header__minicart--items">
                         <a class="header__account--btn minicart__open--btn" href="javascript:void(0)" data-offcanvas>
                             <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534"
                                 viewBox="0 0 14.706 13.534">
                                 <g transform="translate(0 0)">
                                     <g>
                                         <path data-name="Path 16787"
                                             d="M4.738,472.271h7.814a.434.434,0,0,0,.414-.328l1.723-6.316a.466.466,0,0,0-.071-.4.424.424,0,0,0-.344-.179H3.745L3.437,463.6a.435.435,0,0,0-.421-.353H.431a.451.451,0,0,0,0,.9h2.24c.054.257,1.474,6.946,1.555,7.33a1.36,1.36,0,0,0-.779,1.242,1.326,1.326,0,0,0,1.293,1.354h7.812a.452.452,0,0,0,0-.9H4.74a.451.451,0,0,1,0-.9Zm8.966-6.317-1.477,5.414H5.085l-1.149-5.414Z"
                                             transform="translate(0 -463.248)" fill="currentColor" />
                                         <path data-name="Path 16788"
                                             d="M5.5,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,5.5,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,6.793,478.352Z"
                                             transform="translate(-1.191 -466.622)" fill="currentColor" />
                                         <path data-name="Path 16789"
                                             d="M13.273,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,13.273,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,14.566,478.352Z"
                                             transform="translate(-2.875 -466.622)" fill="currentColor" />
                                     </g>
                                 </g>
                             </svg>
                             <span class="items__count">{{ $cartCount }}</span>

                             {{-- <div id="cart-price"></div> --}}
                             <span class="minicart__btn--text">My Cart <br>
                                 <span class="minicart__btn--text__price">
                                     {{ '$' . number_format($cartTotal, 2) }}
                                 </span>
                             </span>
                             {{-- <span class="items__count">{{ count(session('cart', [])) }}</span>
                             <span class="minicart__btn--text">My Cart <br>
                                 <span class="minicart__btn--text__price" id="header_cart_total">
                                     @php
                                         $total = 0;
                                         foreach (session('cart', []) as $item) {
                                             $price = $item['sale_price'] ?: $item['original_price'];
                                             $total += $price * $item['quantity'];
                                         }
                                         echo '$' . number_format($total, 2);
                                     @endphp
                                 </span>
                             </span> --}}
                         </a>
                     </li>
                 </ul>
             </div>
             {{-- end sticky mobile header --}}
             <!-- End sticky header menu -->

         </div>
     </div>
 </div>


 {{-- Search input field in mobile mode top on hero section --}}
 <div class="seach_form_container">
     <form class="d-flex header__search--form border-radius-5" action="{{ route('search.page') }}" method="GET">
         <div class="header__search--box">
             <label for="search_field">
                 <input id="globalSearch" name="query" class="header__search--input"
                     placeholder="Search For Products..." type="text" autocomplete="off"
                     value="{{ request()->query('query') }}">
             </label>
             <button class="header__search--button bg__primary text-white" aria-label="search button" type="submit">
                 <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path
                         d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                         fill="currentColor" />
                 </svg>
             </button>
             <div id="searchResults" class="search-results" style="display:none;"></div>
         </div>
     </form>
 </div>
 {{-- End Search input field --}}
