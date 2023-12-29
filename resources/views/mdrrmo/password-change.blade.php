
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
        <h2 class="text-center mb-4">Change password</h2>
        <form method="POST" action="/passwordChange"  onsubmit="return validatePasswords()">
          @csrf
          <div class="form-group">
        <label for="new_password">{{ __('New Password') }}</label>
        <input id="new_password" type="password" class="form-control" name="new_password" required>
        <x-input-error :messages="$errors->get('new_password')" class="mt-2" style="color: red; text-transform: none;"/>
        <span id="newPasswordError" class="text-danger"></span>
    </div>

    <br>

    <div class="form-group">
        <label for="new_password_confirmation">{{ __('Confirm New Password') }}</label>
        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
        <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" style="color: red; text-transform: none;"/>
        <span id="confirmPasswordError" class="text-danger"></span>
    </div>
 <br>
          <button type="submit" class="btn btn-primary w-100"><i class="fa fa-arrow-right"></i>submit</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js (for Bootstrap modal, dropdown, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function validatePasswords() {
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#new_password_confirmation').val();

        // Check if passwords match
        if (newPassword !== confirmPassword) {
            // Passwords don't match, display alert and return false to prevent form submission
            alert('Passwords do not match!');
            return false;
        }

        // Passwords match, allow form submission
        return true;
    }
</script>