<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Account Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #dddddd;
        }

        h1 {
            color: #0088cc;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .footer {
            font-size: 0.8em;
            margin-top: 20px;
            border-top: 1px solid #dddddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Account Mail</h1>
        <p>Dear {{ $user->name }},</p>

        <p>Congratulations! Your new account has been created successfully. Here are the details:</p>

        <ul>
            <li>Name: {{ ucfirst($user->name) }}</li>
            <li>SSN: {{ $user->ssn }}</li>
            <li>Email: {{ $user->email }}</li>
            <li>Card Number: {{ $card->id }}</li>
            <li>Expiration Date: {{ $card->exp_date }}</li>
            <li>CVV: {{ $card->cvv }}</li>
            <li>Account Type: {{ ucfirst($type) }}</li>
            <li>Default PIN Code: {{ '0000' }}</li>
        </ul>

        <p>Please keep this information safe and do not share it with anyone.</p>

        <div class="footer">
            <p>Best regards,</p>
            <p>Your Company Name</p>

            <p style="font-size: 0.8em;">Important: Create Your PIN Code</p>
            <p>To activate your card and start using your account, please visit the nearest ATM and create your PIN code.</p>
        </div>
    </div>
</body>
</html>
