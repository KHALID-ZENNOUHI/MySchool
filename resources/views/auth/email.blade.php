<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Password Reset</h1>
        <p>Hello {{ $user->username }},</p>
        <p style="margin-bottom: 20px;">You requested a password reset. Click the button below to reset your password:</p>
        <p style="text-align: center;">
            <a href="{{ url('resetPassword/' . $user->remember_token) }}" class="button">Reset Your Password</a>
        </p>
        <p>If you didn't request a password reset, please ignore this email.</p>
        <p>If you have any questions, please feel free to contact us.</p>
        <p>Thanks,<br>
        <em>{{ config('app.name') }}</em></p>
    </div>
</body>
</html>
