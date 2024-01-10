<!-- resources/views/send_email.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Email verification</title>
</head>
<body>
<p>Hello,</p>
<p>This is from Pangasinan PDRRMO.</p>

<div class="card">
  <h5 class="card-header">Resquire</h5>
  <div class="card-body">
    <h5 class="card-title"> <img src="{{ asset('images/logo.png') }}" alt="Vanamo Logo" width="150">
<p class="card-text">Hello, </p>
 <p class="card-text">This is from Pangasinan PDRRMO. </p>
    <p class="card-text">Your temporary access code: {{ $randomPassword }}.</p>
   
         <p class="card-text">Click the following link to access the system:</p>
    <a href="#" class="btn btn-primary">System Login</a>
     <p class="card-text">Best regards,</p>
      <p class="card-text">Pangasinan PDRRMO.</p>
  </div>
</div>
</body>
</html>
