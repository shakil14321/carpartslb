<div class="offCanvas__minicart">
    <div class="minicart__header ">
        <div class="minicart__header--top d-flex justify-content-between align-items-center">
            <h3 class="minicart__title">Shopping Cart</h3>
            <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        <p class="minicart__header--desc">Ready to Checkout?</p>
    </div>

    <div class="minicart__product"></div>

    <div class="minicart__amount">
        <div class="minicart__amount_list d-flex justify-content-between">
            <span>Total:</span>
            <span><b id="cart_total">$0.00</b></span>
        </div>
    </div>

    <div class="minicart__conditions text-center mt-2">
        <input class="minicart__conditions--input" id="accept_policy" type="checkbox">
        <label class="minicart__conditions--label" for="accept_policy">
            I agree with the
            <a class="minicart__conditions--link privacy_policy" href="<?php echo e(route('privacyPolicy')); ?>">
                Privacy Policy
            </a>
        </label>
    </div>

    <div class="minicart__button d-flex justify-content-center mt-3 gap-2">
        <a class="primary__btn minicart__button--link text-center" id="checkout_cart_btn" href="<?php echo e(route('checkout.page')); ?>" style="width:100% !important;">Checkout</a>
    </div>
</div>
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/Front/offcanvas_cart.blade.php ENDPATH**/ ?>