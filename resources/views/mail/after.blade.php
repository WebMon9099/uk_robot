<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
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
        <h2>{{ $title }}</h2>
        <p>Hi {{ $updatedData->firstname }},</p>
        <p>Thank you so much for signing up to our newsletter for ROBOT Kombucha - the world’s most sustainable Organic Honey Cola Kombucha!</p>
        <p>ROBOT is a ‘People & Planet’ friendly company - aiming to strive towards a Net Zero Target ~ and we have developed ROBOT Organic Honey Cola Kombucha to be as sustainable and as delicious as possible.</p>
        <p>This means we do not use any refined sugar, no industrial chemicals, no added coloring, no GMO’s or nasty things of any kind whatsoever in our wonderful Kombucha.</p>
        <p>On the contrary, our Kombucha is made by hand, using only the finest organic ingredients ~ and we brew it over several weeks to give it the rich and complex depth of flavor that it has ~ as well as the gazillions of little beneficial gut microbial goodness that a high-quality Kombucha should have.</p>
        <p>No wonder we are winning awards for our dedication to quality and sustainability..</p>
        <p>Talking of which, our main focus at ROBOT is not just in creating incredible sustainable drinks.</p>
        <p>We have a very strong focus on our changing climate, and the effects it has on food security around the globe.</p>
        <p>We are passionate about taking steps towards positive change, and we aim to design solutions for some of the world’s most damaging foods.</p>
        <p>ROBOT Kombucha for example, is aimed at offering a truly viable, delicious and sustainable solution to the worlds most polluting, most sugar-laden, most plastic polluting drink. Did you guess which one that is?</p>
        <p>We would love to keep you informed of our work at ROBOT, including the exciting development of ME ~ ‘GESPLE’ the Ai ROBOT.</p>
        <p>Thank you once again for your interest in ROBOT Kombucha ~ we will endeavor to keep you posted with more exclusive and up-to-date information on all our products and ideas, and also about the changing climate.</p>
        <p>Much love,</p>
        <p>GESPLE</p>
        <p>Ai Bot</p>
    </div>
</body>

</html>
