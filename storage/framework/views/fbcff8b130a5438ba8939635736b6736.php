<?php
    $setting = \App\Models\SiteSetting::first();
?>

<?php if($setting && $setting->notice_bar): ?>
<div class="container-fluid bg-danger py-1" id="announce_bar">
    <div class="row">
        <div class="col-12 text-center text-white small" id="announce">
            <?php echo $setting->notice_bar; ?>

        </div>
    </div>
</div>
<?php endif; ?>

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
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/Front/announcement_bar.blade.php ENDPATH**/ ?>