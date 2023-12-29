<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f1f1f1;
    }

    .container {
      max-width: 1000px;
      margin-top: 100px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    .image-container {
      flex: 1;
      overflow: hidden;
      padding: 0;
      margin: 0;
    }

    .login-container {
      flex: 1;
      padding: 30px;
      background-color: #fff;
    }

    .login-container h2 {
      color: #333;
    }

    .form-label {
      font-weight: bold;
      color: #555;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .fa {
      margin-right: 10px;
    }

    .error-message {
      color: #ff5858;
      font-size: 14px;
      margin-top: 5px;
    }

    .checkbox-label {
      margin-top: 10px;
    }

    .checkbox-label input {
      margin-right: 5px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row">
      <!-- Image Container -->
      <div class="col-md-6 image-container">
        <img src="{{ asset('images/resquire12.png') }}" alt="Login Image" class="img-fluid" style="height: 100%;">
      </div>

      <!-- Login Container -->
      <div class="col-md-6 login-container"><br>
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
            <div class="error-message">
              @error('email')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa fa-lock"></i> Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="error-message">
              @error('password')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-check">
                            @if (Route::has('password.request'))
            <a style="text-decoration: none;" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
  {{ __('Forgot your password?') }}
</a>

            @endif
                        </div><br><br>
          <button type="submit" class="btn btn-primary w-100"><i class="fa fa-arrow-right"></i> Login</button>
      
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js (for Bootstrap modal, dropdown, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
