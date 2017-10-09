<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300" rel="stylesheet">
    <title>Contact Us</title>
    <style>
        html, body {
            font-family: 'Alegreya Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        Hello <b>Admin</b>,
        <p>
           <b>{{ $name }}</b> of phone number <b>{{ $phone_number }}</b> sent you a message via <a href="http://www.justabus.com">justabus.com</a> contact form. Here is the message...
        </p>
        <div class="container">
            <p>{{ $user_message }}</p>
        </div>
        <p>
            Regards, <br>
            Site generated content.
        </p>
    </div>
</body>
</html>