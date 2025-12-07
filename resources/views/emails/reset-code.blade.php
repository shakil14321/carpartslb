<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic Reset */
        body,
        table,
        td,
        p {
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
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header */
        .email-header {
            background-color: #007bff;
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
            background: #f3f7ff;
            border: 2px dashed #007bff;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
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
            <h1>Password Reset Request</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Hi <strong>{{ $name ?? 'User' }}</strong>,</p>
            <p>We received a request to reset your password.</p>

            <div class="code-box">
                {{ $token }}
            </div>

            <p>This code will expire in <strong>20 minutes</strong>.</p>
            <p>If you did not request this, you can safely ignore this email.</p>

            <p style="margin-top:25px;">Thanks,<br><strong>Car Parts Lb Support Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© {{ date('Y') }} carpartslb.com. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
