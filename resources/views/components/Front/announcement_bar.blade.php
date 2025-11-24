@php
    $setting = \App\Models\SiteSetting::first();
@endphp

@if($setting && $setting->notice_bar)
<div class="container-fluid bg-danger py-1" id="announce_bar">
    <div class="row">
        <div class="col-12 text-center text-white small" id="announce">
            {!! $setting->notice_bar !!}
        </div>
    </div>
</div>
@endif

<script>
    const announce = document.getElementById("announce");
    const announceBar = document.getElementById("announce_bar");

    if (announce && announceBar) {
        // innerText se text lete hain aur trim() extra spaces hata deta hai
        const text = announce.innerText.trim();

        if (text === "") {
            announceBar.style.display = "none";
        }
    }
</script>
