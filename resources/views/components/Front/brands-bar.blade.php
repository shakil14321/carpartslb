<!-- Start product section -->
<section class="brand_bar_wrapper">
    <div class="container pt-3">
        <div class="product__section--inner pb-15">
            <div class="slide_wrapper">
                @php
                    $setting = \App\Models\SiteSetting::first();
                    $carBrandQuantity = $setting ? $setting->brand_quantity : 0;
                    $carPartBrands = \App\Models\CarPartBrand::take($carBrandQuantity)->get();
                @endphp
                
                @if($carPartBrands->count() > 0)
                    @foreach($carPartBrands as $carPartBrand)
                        <div class="slide_item">
                            <p class="bar_brands_names">
                                <a href="{{ route('partBrand.view', $carPartBrand->slug) }}">{{ $carPartBrand->title }}</a>
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="product__card--title text-white">Car brands not found.</p> 
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End product section -->


<!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".bar_brands_names a");

    if (links.length > 0) {
        links.forEach(link => link.classList.remove("active"));

        const currentUrl = window.location.href;
        links.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");
            }
        });

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");
            });
        });
    }
});
</script>

