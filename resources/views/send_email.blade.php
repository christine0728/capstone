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
<p>This is from Pangasinan PDRRMO.</p>

<p>Your temporary access code: {{ $randomPassword }}</p>
<p>For security reasons, we recommend changing this password upon login.</p>
<p>Click the following link to access the system: <a href="{{ url('/login') }}">System Login</a></p>
<p>Best regards,<br>
Pangasinan PDRRMO.</p>

</body>
</html>
