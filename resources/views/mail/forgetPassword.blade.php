<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 50vh;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666666;
            margin-bottom: 16px;
        }

        /* Button styling */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1d2023;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #1d2023bd;
            color: #ffffff;
            transform: scale(1.05);
        }

        .btn:active {
            background-color: #1d2023a0;
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <p>Welcome to Robot Kombucha! To change your password, please click the button below to reset your password.</p>
        <p>
            <a href="{{ route('reset.password.get', $token) }}" class="btn">Reset Password</a>
        </p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Best regards,</p>
        <p>The Robot Kombucha Team</p>
    </div>
</body>

</html>
