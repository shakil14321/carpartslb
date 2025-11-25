<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Verification Code</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Reset */
    body, table, td, p {
      margin: 0;
      padding: 0;
    }
    body {
      background-color: #f4f4f4;
      font-family: 'Arial', sans-serif;
      color: #333;
      line-height: 1.6;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }

    /* Container */
    .email-container {
      max-width: 600px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    /* Header */
    .email-header {
      background-color: #28a745;
      color: #ffffff;
      text-align: center;
      padding: 25px 15px;
    }
    .email-header h1 {
      font-size: 24px;
      margin: 0;
    }

    /* Body */
    .email-body {
      padding: 30px 25px;
    }
    .email-body p {
      margin-bottom: 16px;
      font-size: 16px;
    }

    .code-box {
      background: #f2fff5;
      border: 2px dashed #28a745;
      padding: 15px;
      text-align: center;
      border-radius: 8px;
      font-size: 22px;
      font-weight: bold;
      color: #28a745;
      letter-spacing: 2px;
      margin: 20px 0;
    }

    /* Footer */
    .email-footer {
      background: #f8f8f8;
      text-align: center;
      padding: 15px;
      font-size: 13px;
      color: #666;
    }

    /* Responsive */
    @media only screen and (max-width: 600px) {
      .email-body {
        padding: 20px 15px;
      }
      .email-header h1 {
        font-size: 20px;
      }
      .code-box {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>

  <div class="email-container">
    <!-- Header -->
    <div class="email-header">
      <h1>Email Verification</h1>
    </div>

    <!-- Body -->
    <div class="email-body">
      <p>Hi <strong><?php echo e($name ?? 'User'); ?></strong>,</p>
      <p>Thank you for signing up! Please use the following code to verify your email address:</p>

      <div class="code-box">
        <?php echo e($code); ?>

      </div>

      <p>This code will expire in <strong>20 minutes</strong>.</p>
      <p>If you did not request this verification, please ignore this email.</p>

      <p style="margin-top:25px;">Thanks,<br><strong>adsSoftware Support Team</strong></p>
    </div>

    <!-- Footer -->
    <div class="email-footer">
      <p>© <?php echo e(date('Y')); ?> adsSoftware. All rights reserved.</p>
    </div>
  </div>

</body>
</html>
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/emails/verify-code.blade.php ENDPATH**/ ?>