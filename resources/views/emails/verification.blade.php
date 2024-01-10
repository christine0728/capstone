<!-- resources/views/emails/verification.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        h1 {
            color: #3498db;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background-color: #29c5f6;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }

        a:hover {
           
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Verification</h1>
        <h5 class="card-title">  
        <a href="https://imgbb.com/" style="text-decoration: none;">
    <img src="https://i.ibb.co/zX5T55b/logo.png" alt="logo" style="display: block; border: 0; margin: 0; padding: 0; width: 150px;">
</a>

        <p>Hello,</p>
        <p>This is from Pangasinan PDRRMO.</p>
        <p>Your temporary access code: {{ $randomPassword }}</p>
        <p>Please click the following link to verify your email:</p>
        <a href="{{ $verificationLink }}" style="color:white;">Verify Email</a>
        <p>Best regards,<br>Pangasinan PDRRMO.</p>
    </div>
</body>
</html>
