@extends('layouts.app')

@section('content')
<header>
    <!-- CART ICON -->
    <ul class="header__account">
        <li class="header__account--items header__minicart--items">
            <a class="header__account--btn minicart__open--btn" href="javascript:void(0)" data-offcanvas>
                <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534" viewBox="0 0 14.706 13.534">
                    <path d="M4.738,472.271h7.814..." fill="currentColor"></path>
                </svg>
                <span class="items__count">{{ collect(session('cart', []))->sum('qty') }}</span>
                <span class="minicart__btn--text">My Cart <br> 
                    <span class="minicart__btn--text__price">
                        ${{ collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['qty']) }}
                    </span>
                </span>
            </a>
        </li>
    </ul>
</header>

<!-- PRODUCT LIST EXAMPLE -->
<div class="product__variant--list quantity d-flex align-items-center mb-20">
    <div class="quantity__box">
        <button type="button" class="quantity__value decrease" data-action="decrease">-</button>
        <label>
            <input type="number" class="quantity__number" value="1" data-counter>
        </label>
        <button type="button" class="quantity__value increase" data-action="increase">+</button>
    </div>
    <button 
        class="primary__btn add-to-cart-btn"
        data-id="{{ $carPart->id }}"
        data-name="{{ $carPart->name }}"
        data-price="{{ $carPart->price }}"
        type="button">
        Add To Cart
    </button>
</div>

<!-- MINI CART SIDEBAR -->
<div class="offCanvas__minicart">
    @include('components.Front.offcanvas_cart', [
        'cart' => session('cart', []),
        'subtotal' => collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['qty'])
    ])
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    // Add to cart using fetch
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', async function(){
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = this.dataset.price;
            const qtyInput = this.closest('.product__variant--list').querySelector('.quantity__number');
            const qty = qtyInput ? qtyInput.value : 1;

            const res = await fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({id, name, price, qty})
            });
            const data = await res.json();

            // Update header icon
            document.querySelector('.items__count').textContent = data.cart_count;
            document.querySelector('.minicart__btn--text__price').textContent = '$' + data.cart_total;

            // Update mini cart HTML
            document.querySelector('.offCanvas__minicart').innerHTML = data.mini_cart;
            attachRemoveEvents(); // re-bind remove buttons
        });
    });

    // Attach remove event dynamically
    function attachRemoveEvents(){
        document.querySelectorAll('.minicart__product--remove').forEach(btn => {
            btn.addEventListener('click', async function(){
                const id = this.dataset.id;
                const res = await fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({id})
                });
                const data = await res.json();

                // Refresh mini cart via fetch
                const htmlRes = await fetch("{{ route('cart.mini') }}");
                const html = await htmlRes.text();
                document.querySelector('.offCanvas__minicart').innerHTML = html;

                // Update cart count/price in header again
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                const count = tempDiv.querySelectorAll('.minicart__product--items').length;
                const totalText = tempDiv.querySelector('.minicart__amount b')?.textContent.replace('$','') || '0';
                document.querySelector('.items__count').textContent = count;
                document.querySelector('.minicart__btn--text__price').textContent = '$' + totalText;

                attachRemoveEvents(); // re-bind again
            });
        });
    }
    attachRemoveEvents();

    // Optional: quantity plus/minus
    document.querySelectorAll('.quantity__value').forEach(btn => {
        btn.addEventListener('click', function(){
            const input = this.closest('.quantity__box').querySelector('.quantity__number');
            let val = parseInt(input.value);
            if(this.dataset.action === 'increase') input.value = val+1;
            if(this.dataset.action === 'decrease' && val>1) input.value = val-1;
        });
    });

});
</script>
@endsection
