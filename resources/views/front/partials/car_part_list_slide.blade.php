@if ($carParts->count() > 0)
    @foreach ($carParts as $carPart)
        <div class="col-12 col-sm-6 col-md-3 mb-30">
            <article class="product__card">
                <div class="product__card--thumbnail">
                    <a class="product__card--thumbnail__link display-block"
                       href="{{ route('product.view', $carPart->slug) }}"
                       style="height:210px !important;">

                        <img class="product__card--thumbnail__img product__primary--img"
                             src="{{ asset($carPart->feature_image ? 'images/parts/feature/' . $carPart->feature_image : 'images/parts/feature/product-preview.jpg') }}"
                             alt="feature_img"
                             style="width:100%; height:100%; object-fit:cover;">

                        <img class="product__card--thumbnail__img product__secondary--img"
                             src="{{ asset($carPart->feature_image ? 'images/parts/feature/' . $carPart->feature_image : 'images/parts/feature/product-preview.jpg') }}"
                             alt="feature_img"
                             style="width:100%; height:100%; object-fit:cover;">
                    </a>

                    @php
                        $original_price = $carPart->original_price;
                        $sale_price = $carPart->sale_price;

                        if ($original_price > 0 && $sale_price < $original_price) {
                            $percent_discount = round((($original_price - $sale_price) / $original_price) * 100);
                        } else {
                            $percent_discount = 0;
                        }
                    @endphp

                    @if($percent_discount > 0)
                        <span class="product__badge">-{{ $percent_discount }}%</span>
                    @endif
                </div>

                <div class="product__card--content">
                    <h3 class="product__card--title">
                        <a href="{{ route('product.view', $carPart->slug) }}">
                            {{ $carPart->title ?? '' }}
                        </a>
                    </h3>

                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="oth_brand_title">
                                <span class="oth_p">Brand:</span>
                                <span class="rating__review--text">
                                    {{ strtoupper($carPart->brand->title ?? '') }}
                                </span>
                            </p>

                            <p class="oth_p_part">
                                <span class="oth_p">Part#:</span>
                                <span class="rating__review--text">
                                    {{ ucwords($carPart->part_number ?? '') }}
                                </span>
                            </p>
                        </div>

                        <div class="part_brnad_image_sec">
                            <img src="{{ asset('images/brands/' . ($carPart->SubCategories->brand_image ?? 'demo.png')) }}"
                                 alt="{{ $carPart->SubCategories->title ?? 'Brand Image' }}"
                                 style="width:120px; height:60px; border:1px solid #a7a8a3; border-radius:10px;">
                        </div>
                    </div>

                    <div class="product__card--price">
                        <span class="current__price">
                            {{ $carPart->sale_price ? '$' . $carPart->sale_price : '' }}
                        </span>

                        <span class="old__price">
                            {{ $carPart->original_price ? '$' . $carPart->original_price : '' }}
                        </span>
                    </div>

                    <div class="product__card--footer_swiper">
                        <button class="product__card--btn primary__btn add-to-cart-btn"
                                data-id="{{ $carPart->id }}"
                                data-name="{{ $carPart->title }}"
                                data-price="{{ $carPart->price }}"
                                data-sale_price="{{ $carPart->sale_price ?? '' }}"
                                data-original_price="{{ $carPart->original_price ?? '' }}"
                                data-slug="{{ $carPart->slug ?? '' }}"
                                data-sku="{{ $carPart->sku ?? '' }}"
                                data-part_number="{{ $carPart->part_number ?? '' }}"
                                data-image="{{ $carPart->feature_image ?? 'demo.png' }}"
                                type="button">
                            Add To Cart
                        </button>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
@else
    <div class="col-12">
        <h3 class="product__card--title">No featured products found</h3>
    </div>
@endif
