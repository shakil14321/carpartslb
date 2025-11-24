@if($latestParts->count() > 0)
@foreach($latestParts as $latestPart)
<div class="col-lg-4 col-md-4 col-sm-6 col-6 custom-col mb-30">
    <article class="product__card">
        <div class="product__card--thumbnail">
            <a class="product__card--thumbnail__link display-block" href="{{ route('product.view', $carPart->slug) }}" style="height:210px !important;">
                @if($carPart->feature_image)
                    <img class="product__card--thumbnail__img product__primary--img"
                    src="{{ asset($carPart->feature_image ? 'public/images/parts/feature/' . $carPart->feature_image : 'public/images/parts/feature/product-preview.jpg') }}"
                    alt="feature_img" style="width:100%; height:100%; object-fit:cover;">

                @endif
                
                 @if($carPart->feature_image)
                    <img class="product__card--thumbnail__img product__secondary--img"
                    src="{{ asset($carPart->feature_image ? 'public/images/parts/feature/' . $carPart->feature_image : 'public/images/parts/feature/product-preview.jpg') }}"
                    alt="feature_img" style="width:100%; height:100%; object-fit:cover;">
                @endif

            </a>
            @php
            $original_price = $latestPart->original_price;
            $sale_price = $latestPart->sale_price;
            $percent_discount = round(($original_price - $sale_price) /
            $original_price * 100);
            @endphp
            <span class="product__badge">-{{ $percent_discount ?? '' }}%</span>
            <ul class="product__card--action d-flex align-items-center justify-content-center">
                <li class="product__card--action__list">
                    <a class="product__card--action__btn" title="Quick View" data-bs-toggle="modal"
                        data-bs-target="#examplemodal" href="javascript:void(0)">
                        <svg class="product__card--action__btn--svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                fill="currentColor"></path>
                        </svg>
                        <span class="visually-hidden">Quick View</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="product__card--content">
            
            <h3 class="product__card--title"><a href="{{ route('product.view', $carPart->slug) }}">{{
                    $carPart->title ?? '' }}</a></h3>
                    
            <div class="d-flex justify-content-between">
                <div>
                    <p class="oth_brand_title"><span class="oth_p">Brand:</span> <span class="rating__review--text">{{
                            strtoupper($carPart->carBrand->title ?? '') }}</span></p>
                            
                    {{-- <p class="oth_p_m"><span class="oth_p">Type:</span> <span class="rating__review--text">{{
                            ucwords($carPart->carPartType->title ?? '' ) }}</span></p> --}}
                            
                    <p class="oth_p_part"><span class="oth_p">Part#:</span> <span class="rating__review--text">{{
                            ucwords($carPart->part_number ?? '') }}</span></p>
                </div>
                <div class="part_brnad_image_sec">
                    <img 
                        src="{{ asset('public/images/brands/' . ($carPart->carPartBrand->brand_image ?? 'demo.png')) }}" 
                            alt="{{ $carPart->carPartBrand->title ?? 'Brand Image' }}" style="width:120px; height:60px; border:1px solid #a7a8a3; border-radius:10px;" 
                    />
                </div>
            </div>
                    
            <div class="product__card--price">
                <span class="current__price">{{ $latestPart->sale_price ?
                    '$'.$latestPart->sale_price :
                    ''}}</span>
                <span class="old__price"> {{ $latestPart->original_price ?
                    '$'.$latestPart->original_price :
                    ''}}</span>
            </div>
            <div class="product__card--footer">
                <button class="product__card--btn primary__btn add-to-cart-btn"  
                    data-id="{{ $carPart->id }}"
                    data-name="{{ $carPart->title }}"
                    data-price="{{ $carPart->price }}"
                    data-sale_price="{{ $carPart->sale_price ?? '' }}"
                    data-original_price="{{ $carPart->original_price ?? '' }}"
                    data-slug="{{ $carPart->slug ?? '' }}"
                    data-image="{{ $carPart->feature_image ?? 'demo.png' }}"
                    type="button">
                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                            fill="currentColor" />
                    </svg>
                    Add To Cart
                </button>
            </div>
        </div>
    </article>
</div>
@endforeach
@else
<h3 class="product__card--title">No related products found</h3>
@endif