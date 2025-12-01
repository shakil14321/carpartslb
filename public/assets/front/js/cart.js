$(document).ready(function () {

    // ------------------------------------------
    // ADD TO CART BUTTON
    // ------------------------------------------
    $('.add-to-cart-btn').on('click', function () {
        const quantity = $(this).closest('.product__variant--list').find('.quantity-input').val() || 1;
        const payload = {
            product_id: $(this).data('id'),
            sale_price: $(this).data('sale_price') || null,
            original_price: $(this).data('original_price') || null,
            sku: $(this).data('sku') || null,
            part_number: $(this).data('part_number') || null,
            quantity: parseInt(quantity)
        };

        $.ajax({
            url: cartAddUrl,
            method: "POST",
            data: payload,
            headers: {
                "X-CSRF-TOKEN": window.csrfToken,
                "Accept": "application/json"
            },
            success: function (data) {
                if (data.success) {
                    // Only update cart if success
                    updateMiniCart(data);

                    // Update counter & total price
                    $(".items__count").text(data.count);
                    $(".minicart__btn--text__price").html(data.total);

                    toastr.success("Product added to cart!");
                } else {
                    // If not success, show warning
                    toastr.warning(data.message);
                }
                // console.log("Cart updated", data);
                // updateMiniCart(data);
                // // Update counter
                // $(".items__count").text(data.count);

                // // Update total price
                // console.log($("#header_cart_total"));
                // $(".minicart__btn--text__price").html(data.total);
                // toastr.success("Product added to cart!");

            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    // Backend message
                    const res = xhr.responseJSON;
                    if (res && res.message) {
                        toastr.warning(res.message);
                    } else {
                        toastr.warning("Please login to add items to cart.");
                    }
                } else {
                    console.error("Add to cart error:", xhr.responseText);
                }
            }
        });

    });


    // ------------------------------------------
    // UPDATE QUANTITY BUTTONS
    // ------------------------------------------
    $(document).on('click', '.cart-qty-btn', function () {

        const payload = {
            id: $(this).data('id'),
            type: $(this).data('type')
        };

        $.ajax({
            url: cartUpdateUrl,
            method: "POST",
            data: payload,
            headers: {
                "X-CSRF-TOKEN": window.csrfToken
            },
            success: function (data) {
                updateMiniCart(data);
            },
            error: function (xhr) {
                console.error("Update quantity error:", xhr.responseText);
            }
        });

    });


    // ------------------------------------------
    // REMOVE CART ITEM BUTTON
    // ------------------------------------------
    $(document).on('click', '.remove-cart-item', function () {

        const payload = {
            id: $(this).data('id')
        };

        $.ajax({
            url: cartRemoveUrl,
            method: "POST",
            data: payload,
            headers: {
                "X-CSRF-TOKEN": window.csrfToken
            },
            success: function (data) {
                updateMiniCart(data);
                $(".items__count").text(data.count);

                // Update header total
                $(".minicart__btn--text__price").text(data.total);
            },
            error: function (xhr) {
                console.error("Remove cart item error:", xhr.responseText);
            }
        });

    });


    // ------------------------------------------
    // FETCH CART DATA
    // ------------------------------------------
    function fetchCartData() {

        $.ajax({
            url: cartDataUrl,
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": window.csrfToken
            },
            success: function (data) {
                updateMiniCart(data);
            },
            error: function (xhr) {
                console.error("Fetch cart data error:", xhr.responseText);
            }
        });

    }


    // ------------------------------------------
    // UPDATE MINI CART UI
    // ------------------------------------------
    function updateMiniCart(data) {

        $('#cart-count').text(data.count);
        $('#cart_total').text(data.total);

        const listElem = $('.minicart__product');
        listElem.html('');

        data.cart.forEach(item => {
            listElem.append(`
                <div class="minicart__item">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${window.baseUrl}public/images/parts/feature/${item.product.feature_image}"
                                 width="50" height="50" style="object-fit:cover;">
                            <span>${item.product.title}</span>
                        </div>
                        <div>
                            <button class="cart-qty-btn" data-id="${item.id}" data-type="minus">-</button>
                            <span>${item.quantity}</span>
                            <button class="cart-qty-btn" data-id="${item.id}" data-type="plus">+</button>
                            <button class="remove-cart-item btn btn-sm text-danger" data-id="${item.id}">x</button>
                        </div>
                    </div>
                </div>
            `);
        });

    }


    // ------------------------------------------
    // INITIAL LOAD
    // ------------------------------------------
    fetchCartData();

});




// document.addEventListener('DOMContentLoaded', function () {

//     // -------------------------------
//     // ADD TO CART BUTTON
//     // -------------------------------

//     document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
//         btn.addEventListener('click', function () {
//             const payload = {
//                 product_id: this.dataset.id,
//                 sale_price: this.dataset.sale_price || null,
//                 original_price: this.dataset.original_price || null,
//                 sku: this.dataset.sku || null,
//                 part_number: this.dataset.part_number || null,
//             };

//             fetch('/cart/add', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify(payload)
//             })
//                 .then(res => res.json())
//                 .then(data => {
//                     console.log('Cart updated', data);
//                     updateMiniCart(data);
//                 })
//                 .catch(err => console.error('Add to cart error:', err));
//         });
//     });

//     // -------------------------------
//     // UPDATE QUANTITY BUTTONS
//     // -------------------------------
//     document.addEventListener('click', function (e) {
//         if (e.target.classList.contains('cart-qty-btn')) {
//             const cartId = e.target.dataset.id;
//             const type = e.target.dataset.type;

//             fetch('/cart/update-quantity', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({ id: cartId, type: type })
//             })
//                 .then(res => res.json())
//                 .then(data => updateMiniCart(data))
//                 .catch(err => console.error('Update quantity error:', err));
//         }
//     });

//     // -------------------------------
//     // REMOVE ITEM BUTTON
//     // -------------------------------
//     document.addEventListener('click', function (e) {
//         if (e.target.classList.contains('remove-cart-item')) {
//             const cartId = e.target.dataset.id;

//             fetch('/cart/remove', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({ id: cartId })
//             })
//                 .then(res => res.json())
//                 .then(data => updateMiniCart(data))
//                 .catch(err => console.error('Remove cart item error:', err));
//         }
//     });

//     // -------------------------------
//     // FETCH CART DATA FUNCTION
//     // -------------------------------
//     function fetchCartData() {
//         const csrf = document.querySelector('meta[name="csrf-token"]');
//         fetch('/cart/data', {
//             headers: {
//                 'X-CSRF-TOKEN': csrf ? csrf.getAttribute('content') : ''
//             }
//             // headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
//         })
//             .then(res => res.json())
//             .then(data => updateMiniCart(data))
//             .catch(err => console.error('Fetch cart error:', err));
//     }

//     // -------------------------------
//     // UPDATE MINI CART UI
//     // -------------------------------
//     function updateMiniCart(data) {
//         const countElem = document.querySelector('#cart-count');
//         const totalElem = document.querySelector('#cart_total');

//         if (countElem) countElem.textContent = data.count;
//         if (totalElem) totalElem.textContent = data.total;

//         const listElem = document.querySelector('.minicart__product');
//         if (listElem) {
//             listElem.innerHTML = '';
//             data.cart.forEach(item => {
//                 const li = document.createElement('div');
//                 li.classList.add('minicart__item');
//                 li.innerHTML = `
//                     <div class="d-flex justify-content-between align-items-center mb-2">
//                         <div class="d-flex align-items-center gap-2">
//                             <img src="/public/images/parts/feature/${item.product.feature_image}" width="50" height="50" style="object-fit:cover;">
//                             <span>${item.product.title}</span>
//                         </div>
//                         <div>
//                             <button class="cart-qty-btn" data-id="${item.id}" data-type="minus">-</button>
//                             <span>${item.quantity}</span>
//                             <button class="cart-qty-btn" data-id="${item.id}" data-type="plus">+</button>
//                             <button class="remove-cart-item btn btn-sm text-danger" data-id="${item.id}">x</button>
//                         </div>
//                     </div>
//                 `;
//                 listElem.appendChild(li);
//             });
//         }
//     }

//     // Initial fetch
//     fetchCartData();
// });
