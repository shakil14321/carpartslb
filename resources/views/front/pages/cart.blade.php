@extends('layouts.front.front-layout')

@section('content')
<div class="minicart">
    <div class="minicart__header ">
        <div class="minicart__header--top d-flex justify-content-between align-items-center">
            <h3 class="minicart__title"> Shopping Cart</h3>
            <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
                <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                </svg>
            </button>
        </div>
        <p class="minicart__header--desc">Ready to Checkout?</p>
    </div>

    <div class="minicart__product">
        @if(session('cart', []))
        @foreach(session('cart', []) as $key => $value)
        <div class="minicart__product--items d-flex">
            <div class="minicart__thumb">
                <a href="product-details.html">
                    <img src="{{ asset('images/parts/feature/' . ($value['image'] ?? 'demo.png')) }}" alt="product-img">
                </a>
            </div>
            <div class="minicart__text">
                <h4 class="minicart__subtitle"><a href="product-details.html">{{ $value["name"] ?? ' ' }}</a></h4>
                <div class="minicart__price">
                    <span class="minicart__current--price">
                        ${{ $value["sale_price"] ?? $value["original_price"] ?? '0.00' }}
                    </span>
                    <span class="minicart__old--price">
                        ${{ $value["original_price"] ?? '0.00' }}
                    </span>
                </div>
                <div class="minicart__text--footer d-flex align-items-center">
                    <div class="quantity__box minicart__quantity">
                        <button type="button" class="quantity__value decrease" aria-label="quantity value"
                            data-id="{{ $key }}" data-type="minus">-</button>
                        <label>
                            <input type="number" class="quantity__number" value="{{ $value['quantity'] ?? 1 }}" min="1"
                                readonly />
                        </label>
                        <button type="button" class="quantity__value increase" aria-label="quantity value"
                            data-id="{{ $key }}" data-type="plus">+</button>
                    </div>
                    <a href="javascript:void(0);" class="minicart__product--remove remove-from-cart-btn" type="button" data-id="{{ $key }}">Remove</a>
                </div>
            </div>
        </div>
        @endforeach

        @endif

    </div>


    <div class="minicart__amount">
        <div class="minicart__amount_list d-flex justify-content-between">
            <span>Total:</span>
            <span><b id="cart_total">
                    @php
                    $total = 0;
                    foreach(session('cart', []) as $item) {
                    $price = $item['sale_price'] ?: $item['original_price'];
                    $total += $price * $item['quantity'];
                    }
                    echo '$' . number_format($total, 2);
                    @endphp
                </b></span>
        </div>
    </div>


    <div class="minicart__conditions text-center mt-2">
        <input class="minicart__conditions--input" id="accept" type="checkbox">
        <label class="minicart__conditions--label" for="accept">
            I agree with the
            <a class="minicart__conditions--link" href="#">
                Privacy Policy
            </a>
        </label>
    </div>

    <div class="minicart__button d-flex justify-content-center mt-3 gap-2">
        <a class="primary__btn minicart__button--link" href="{{ route('cartView.page') }}">View Cart</a>
        <a class="primary__btn minicart__button--link" href="{{ route('checkout.page') }}">Checkout</a>
    </div>

</div>
<!-- Start shipping section -->
@include('front.partials.shipping_sec')
<!-- End shipping section -->
@endsection
{{-- @section('scripts')
<script>
    window.sessionCart = @json(session('cart', []));
    window.productUrl = "{{ url('product') }}/"; // product base url
    document.addEventListener('DOMContentLoaded', function () {

    // ---- Update Header Price + Count ----
    function updateHeader(total, count) {
        document.querySelectorAll('.minicart__btn--text__price').forEach(el => {
            el.textContent = total;
        });
        document.querySelectorAll('.items__count').forEach(el => {
            el.textContent = count;
        });
    }

    // ---- Update Cart Page Total ----
    function updateCartTotal(total) {
        const totalElement = document.querySelector('#cart_total');
        if (totalElement) totalElement.textContent = total;
    }

    // ---- Render Cart Item in MiniCart ----
    function renderCartItem(item, id) {
        return `
        <div class="minicart__product--items d-flex" data-id="${id}">
            <div class="minicart__thumb">
                <a href="product-details.html">
                    <img src="/images/parts/feature/${item.image ?? 'demo.png'}" alt="product-img">
                </a>
            </div>
            <div class="minicart__text">
                <h4 class="minicart__subtitle"><a href="${window.productUrl}${item.slug}">${item.name ?? 'Title not found'}</a></h4>
                    <span class="minicart__current--price">$${item.sale_price ?? item.original_price}</span>
                    <span class="minicart__old--price">$${item.original_price}</span>
                </div>
                <div class="minicart__text--footer d-flex align-items-center">
                    <div class="quantity__box minicart__quantity">
                        <button type="button" class="quantity__value decrease" data-id="${id}" data-type="minus">-</button>
                        <label><input type="number" class="quantity__number" value="${item.quantity}" readonly /></label>
                        <button type="button" class="quantity__value increase" data-id="${id}" data-type="plus">+</button>
                    </div>
                    <a href="javascript:void(0);" class="minicart__product--remove remove-from-cart-btn" data-id="${id}">Remove</a>
                </div>
            </div>
        </div>`;
    }

    // ---- Add to Cart ----
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateHeader(data.total, data.count);
                    updateCartTotal(data.total);

                    // agar product pehle se exist nahi hai to mini cart me add karo
                    if (!document.querySelector(`.minicart__product--items[data-id="${id}"]`)) {
                        document.querySelector('.minicart__product').insertAdjacentHTML('beforeend', renderCartItem(data.cart[id], id));
                    } else {
                        // agar exist karta hai to quantity update karo
                        const qtyInput = document.querySelector(`.minicart__product--items[data-id="${id}"] .quantity__number`);
                        if (qtyInput) qtyInput.value = data.cart[id].quantity;
                    }
                }
            })
            .catch(err => console.error("Add to cart error:", err));
        });
    });

    // ---- Update Quantity (plus/minus) ----
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('quantity__value')) {
            const id = e.target.getAttribute('data-id');
            const type = e.target.getAttribute('data-type');

            fetch("{{ route('cart.updateQuantity') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: id, type: type })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const productRow = document.querySelector(`.minicart__product--items[data-id="${id}"]`);
                    if (data.cart[id]) {
                        productRow.querySelector('.quantity__number').value = data.cart[id].quantity;
                    } else {
                        productRow.remove();
                    }
                    updateCartTotal(data.total);
                    updateHeader(data.total, data.count);
                }
            })
            .catch(err => console.error("Quantity update error:", err));
        }
    });

    // ---- Remove from Cart ----
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-from-cart-btn')) {
            const id = e.target.getAttribute('data-id');

            fetch("{{ route('cart.remove') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const productRow = document.querySelector(`.minicart__product--items[data-id="${id}"]`);
                    if (productRow) productRow.remove();

                    updateCartTotal(data.total);
                    updateHeader(data.total, data.count);
                }
            })
            .catch(err => console.error("Remove cart error:", err));
        }
    });

});

</script>
@endsection --}}
