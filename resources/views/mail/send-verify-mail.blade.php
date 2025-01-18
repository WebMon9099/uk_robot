<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1d2023;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;

        }

        .btn:hover {
            background-color: #1d2023bd;
            color: white
        }

        a {
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Verify Your Email Address</h2>
        <p>Welcome to our newsletter! To complete your registration, please click the button below to verify your email
            address:</p>
        <p>
            <a href="{{ $url }}" class="btn">Verify Email Address</a>
        </p>
        <p>If you did not sign up for our newsletter, you can ignore this email.</p>
    </div>
</body>

</html>
