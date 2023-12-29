<!-- resources/views/send_email.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Content</title>
</head>
<body>
    <p>Hello,</p>
    <p>This is the content of the email.</p>

    <p>Random Password: {{ $randomPassword }}</p>

    <p>Best regards,<br>
       Your Company</p>
</body>
</html>
