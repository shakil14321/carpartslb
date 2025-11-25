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
<<<<<<<< HEAD:storage/framework/views/9e5de59a9c998f89d34fb9662c775e08.php
<?php /**PATH F:\laragon\www\carpartslb.com\resources\views/components/Front/announcement_bar.blade.php ENDPATH**/ ?>
========
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/Front/announcement_bar.blade.php ENDPATH**/ ?>
>>>>>>>> 111d9aad5c681fcad64fc7e1745777f4ca95bd73:storage/framework/views/fbcff8b130a5438ba8939635736b6736.php
