document.addEventListener('DOMContentLoaded', function () {

    // -------------------------------
    // ADD TO CART BUTTON
    // -------------------------------
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const payload = {
                product_id: this.dataset.id,
                sale_price: this.dataset.sale_price || null,
                original_price: this.dataset.original_price || null,
                sku: this.dataset.sku || null,
                part_number: this.dataset.part_number || null,
            };

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                console.log('Cart updated', data);
                updateMiniCart(data);
            })
            .catch(err => console.error('Add to cart error:', err));
        });
    });

    // -------------------------------
    // UPDATE QUANTITY BUTTONS
    // -------------------------------
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('cart-qty-btn')){
            const cartId = e.target.dataset.id;
            const type = e.target.dataset.type;

            fetch('/cart/update-quantity', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: cartId, type: type })
            })
            .then(res => res.json())
            .then(data => updateMiniCart(data))
            .catch(err => console.error('Update quantity error:', err));
        }
    });

    // -------------------------------
    // REMOVE ITEM BUTTON
    // -------------------------------
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('remove-cart-item')){
            const cartId = e.target.dataset.id;

            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: cartId })
            })
            .then(res => res.json())
            .then(data => updateMiniCart(data))
            .catch(err => console.error('Remove cart item error:', err));
        }
    });

    // -------------------------------
    // FETCH CART DATA FUNCTION
    // -------------------------------
    function fetchCartData(){
        fetch('/cart/data', {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(res => res.json())
        .then(data => updateMiniCart(data))
        .catch(err => console.error('Fetch cart error:', err));
    }

    // -------------------------------
    // UPDATE MINI CART UI
    // -------------------------------
    function updateMiniCart(data){
        const countElem = document.querySelector('#cart-count');
        const totalElem = document.querySelector('#cart_total');

        if(countElem) countElem.textContent = data.count;
        if(totalElem) totalElem.textContent = data.total;

        const listElem = document.querySelector('.minicart__product');
        if(listElem){
            listElem.innerHTML = '';
            data.cart.forEach(item => {
                const li = document.createElement('div');
                li.classList.add('minicart__item');
                li.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <img src="/public/images/parts/feature/${item.product.feature_image}" width="50" height="50" style="object-fit:cover;">
                            <span>${item.product.title}</span>
                        </div>
                        <div>
                            <button class="cart-qty-btn" data-id="${item.id}" data-type="minus">-</button>
                            <span>${item.quantity}</span>
                            <button class="cart-qty-btn" data-id="${item.id}" data-type="plus">+</button>
                            <button class="remove-cart-item btn btn-sm text-danger" data-id="${item.id}">x</button>
                        </div>
                    </div>
                `;
                listElem.appendChild(li);
            });
        }
    }

    // Initial fetch
    fetchCartData();
});
