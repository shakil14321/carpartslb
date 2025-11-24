

<?php $__env->startSection('content'); ?>
<!-- Start breadcrumb section -->
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>Privacy Policy</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->


<!-- start privacy policy section -->
<section aria-label="Privacy Policy" class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <h1 class="text-center mb-4 fw-bold">Privacy Policy</h1>
      <p><strong>Last Updated:</strong> October 12, 2025</p>

      <p>
        Welcome to <a href="https://carpartslb.com/" target="_blank" class="text-danger">www.carpartslb.com</a>
        (“CarPartsLB”, “we”, “us”, or “our”). We respect your privacy and are committed to
        protecting your personal information. This Privacy Policy explains how we collect, use,
        disclose, and safeguard your information when you visit our website or make a purchase from us.
      </p>

      <p>
        By using our website, you agree to the terms of this Privacy Policy. If you do not agree,
        please do not use our website.
      </p>

      <h2 class="mt-5 mb-3">1. Information We Collect</h2>
      <p>We collect information to process your orders, improve our services, and provide a better shopping experience.</p>

      <h3 class="mt-4">a. Personal Information</h3>
      <p>When you place an order, register an account, or contact us, we may collect:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">Full name</li>
        <li class="list-group-item">Email address</li>
        <li class="list-group-item">Phone number</li>
        <li class="list-group-item">Shipping and billing addresses</li>
        <li class="list-group-item">Payment information (processed securely through third-party gateways — we do not store card details)</li>
      </ul>

      <h3>b. Non-Personal Information</h3>
      <p>We may collect non-identifiable information such as:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">Browser type and version</li>
        <li class="list-group-item">Device information</li>
        <li class="list-group-item">IP address and location data</li>
        <li class="list-group-item">Pages visited and time spent on the website</li>
      </ul>

      <h2 class="mt-5 mb-3">2. How We Use Your Information</h2>
      <p>We use your information for the following purposes:</p>

      <h3 class="mt-4">3. Sharing Your Information</h3>
      <p>We do not sell or rent your personal data. However, we may share your information with:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">
          <strong>Service Providers:</strong> Payment processors, shipping companies, and IT support providers that help us operate our business.
        </li>
        <li class="list-group-item">
          <strong>Legal Authorities:</strong> If required by law or to protect our rights and prevent fraud.
        </li>
      </ul>
      <p>All third-party partners are required to handle your data securely and in compliance with privacy standards.</p>

      <h3 class="mt-4">4. Data Security</h3>
      <p>
        We implement appropriate technical and organizational measures to protect your personal data
        against unauthorized access, loss, misuse, or alteration.
      </p>
      <p>
        While we strive to ensure full security, no online transmission or storage system can be guaranteed to be 100% secure.
      </p>

      <h3 class="mt-4">5. Cookies and Tracking Technologies</h3>
      <p>Our website uses cookies and similar technologies to:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">Remember your preferences and login sessions</li>
        <li class="list-group-item">Analyze website traffic and user behavior</li>
        <li class="list-group-item">Deliver personalized offers and ads</li>
      </ul>
      <p>You can manage or disable cookies through your browser settings.</p>

      <h3 class="mt-4">6. Your Rights</h3>
      <p>Depending on your location, you may have the right to:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">Access, correct, or delete your personal information</li>
        <li class="list-group-item">Withdraw consent for marketing communications</li>
        <li class="list-group-item">Request a copy of your data</li>
      </ul>
      <p>
        To exercise these rights, contact us at
        <a href="mailto:carpartslbinfo@gmail.com">carpartslbinfo@gmail.com</a>.
      </p>

      <h3 class="mt-4">7. Third-Party Links</h3>
      <p>
        Our website may contain links to third-party sites. We are not responsible for the privacy
        practices or content of these external websites. Please review their policies separately.
      </p>

      <h3 class="mt-4">8. Children’s Privacy</h3>
      <p>
        We do not knowingly collect personal information from children under the age of 16.
        If you believe your child has provided personal data, please contact us immediately.
      </p>

      <h3 class="mt-4">9. Updates to This Policy</h3>
      <p>
        We may update this Privacy Policy from time to time to reflect changes in our practices or
        for legal reasons. Any updates will be posted on this page with the new effective date.
      </p>

      <h3 class="mt-4">10. Contact Us</h3>
      <p>
        If you have any questions or concerns about this Privacy Policy or how your data is handled,
        please contact us:
      </p>
      <ul class="list-unstyled">
        <li class="mb-4">📧 Email: <a href="mailto:carpartslbinfo@gmail.com">carpartslbinfo@gmail.com</a></li>
        <li class="mb-4">🌐 Website: <a href="https://www.carpartslb.com" target="_blank">www.carpartslb.com</a></li>
        <li>📍 Location: Lebanon</li>
      </ul>
    </div>
  </div>
</section>

<!-- end privacy policy section -->

<!-- Start shipping section -->
<?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- End shipping section -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/front/pages/privacy_policy.blade.php ENDPATH**/ ?>