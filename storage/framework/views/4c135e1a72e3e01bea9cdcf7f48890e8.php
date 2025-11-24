<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Contact Message</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Reset */
    body, table, td, p { margin: 0; padding: 0; }
    body { background-color: #f4f4f4; font-family: 'Arial', sans-serif; color: #333; }
    table { border-collapse: collapse; width: 100%; }
    a { color: #007bff; text-decoration: none; }

    /* Container */
    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    /* Header */
    .email-header {
      background-color: #007bff;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    /* Content */
    .email-body {
      padding: 25px;
    }

    .email-body h2 {
      color: #333;
      margin-bottom: 15px;
      font-size: 22px;
    }

    .detail {
      margin-bottom: 10px;
      font-size: 16px;
      line-height: 1.5;
    }

    .detail strong {
      color: #007bff;
      display: inline-block;
      width: 90px;
    }

    /* Footer */
    .email-footer {
      background-color: #f8f8f8;
      text-align: center;
      font-size: 13px;
      color: #666;
      padding: 15px;
    }

    /* Responsive */
    @media only screen and (max-width: 600px) {
      .email-body {
        padding: 15px;
      }
      .detail strong {
        width: auto;
        display: block;
        margin-bottom: 4px;
      }
    }
  </style>
</head>
<body>

  <div class="email-container">
    <!-- Header -->
    <div class="email-header">
      <h1>📩 New Contact Message</h1>
    </div>

    <!-- Body -->
    <div class="email-body">
      <h2>Contact Details</h2>

      <p class="detail"><strong>Name:</strong> <?php echo e($data['first_name']); ?> <?php echo e($data['last_name']); ?></p>
      <p class="detail"><strong>Email:</strong> <a href="mailto:<?php echo e($data['email']); ?>"><?php echo e($data['email']); ?></a></p>
      <p class="detail"><strong>Phone:</strong> <?php echo e($data['phone']); ?></p>

      <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

      <h3 style="margin-bottom: 10px;">Message:</h3>
      <p style="background:#f8f8f8; padding:15px; border-radius:6px; border:1px solid #eee;">
        <?php echo e($data['message']); ?>

      </p>
    </div>

    <!-- Footer -->
    <div class="email-footer">
      <p>© <?php echo e(date('Y')); ?> adsSoftware. All rights reserved.</p>
    </div>
  </div>

</body>
</html>
<?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/emails/contact.blade.php ENDPATH**/ ?>