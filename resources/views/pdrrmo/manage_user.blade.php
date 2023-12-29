<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resquire</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap CSS -->

    <!-- CSS3 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css')}}">
</head>
<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        @include('/pdrrmo/nav')

        <!-- Page Content -->
        <div id="content">
            @include('/pdrrmo/header')
            <div class="main-content">
                <div class="page-content page-container" id="page-content">
                    <div class="row container d-flex justify-content-center">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card" style="width: 105%;">
                                <div class="card-body">
                                    <h3 style="font-size: 30px;">Manage Users</h3><br>
                                    
                  <form action="/pdrrmo/filter-user" method="get" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date: </label>
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <div class="form-group">
                          <label for="end_date">End Date: </label>
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>
                      &nbsp;

                      <button type="submit" class="btn btn-primary" style="background: #3a9bdc" >Apply Filter</button>&nbsp;
                      <a href="/pdrrmo/manage-user" class="btn btn-secondary">All</a>
                  </form> 
                  <br>
                                    <button type="button" class="btn btn-primary" style="background: #3a9bdc" data-toggle="modal" data-target="#modalRelatedContent">Register Account</button>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Municipality</th>
                                                    <th>Email</th>
                                                    <th>Profile picture</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($accounts as $account)
                                                <tr>
                                                    <td>{{ $account->name }}</td>
                                                    <td>{{ $account->email }}</td>
                                                    <td>  @if($account->image)
                                                            <a href="{{ route('download-pics', ['filename' => $account->image]) }}" target="_blank"><img src="{{ asset('uploads/logo/' . $account->image) }}" width="50px" height="50px"></a>
                                                        @else
                                                            <img src="{{ asset('uploads/logo/logo.png') }}" width="40px" height="40px">
                                                        @endif</td>
                                                    <td>{{ date('F d, Y g:ia', strtotime($account->created_at )) }}</td> 
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm btn-details" data-toggle="modal" data-id="{{ $account->id }}" data-target="#modalEdit">More Details</a>
                                                        <a href="#" onclick="confirmDelete('{{ $account->id }}')" class="btn btn-danger btn-xs btn-sm">
                                        <i style="color: white; font-size: 12px;" class="fas fa-trash-alt"></i>
                                    </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4">No accounts found.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                @include('/pdrrmo/footer')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $('.more-button, .body-overlay').on('click', function () {
                $('#sidebar, .body-overlay').toggleClass('show-nav');
            });
        });
    </script>
</body>
</html>

<div class="modal fade" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!-- Content -->
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">New Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="/register-user" onsubmit="return validatePasswords()">
                            @csrf
                            <!-- uid -->
                            <div class="form-group">
                                <x-input-label for="uid" :value="__('UserId')" />
                                <x-text-input id="uid" class="form-control" type="text" name="uid" :value="old('uid')" required autofocus autocomplete="uid" />
                                <x-input-error :messages="$errors->get('uid')" class="mt-2" style="color: red; text-transform: none;"/>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red; text-transform: none;"/>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red; text-transform: none;"/>
                            </div>

                            <!-- Password -->
                       
                            <!-- Submit Button -->
                            <div class="form-group text">
                                <input type="submit" id="register" name="register" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>



 <div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
        <div class="modal-header btn-primary text-white">
        <h4 style="color:white" class="heading">Account</h4> <span style="font-weight: bold; color: white;" id="municipality_name"></span>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

          <!--Body-->
  
           <div class="modal-body">
           <div class="form-group">
    <strong><label class="req-label"></label></strong>
    <input type="hidden" name="id-info" id="id-info" placeholder="" autocomplete="off" value="">
    <h5 id="incidenttype"></h5>
</div>
<div class="form-group">
    <strong><label class="req-label">Location</label></strong>
    <h5 id="location"></h5>
</div>
<div class="form-group">
    <strong><label class="req-label">Population</label></strong>
    <h5 id="population"></h5>
</div>
<div class="form-group">
    <strong><label class="req-label">Contact Number</label></strong>
    <h5 id="cnumber"></h5>
</div>
<div class="form-group">
    <strong><label class="req-label">Emergency Contact Number</label></strong>
    <h5 id="enumber"></h5>
</div>

        </div>

        </div>
        </div>
      </div>

<script>
  $(document).on('click', '.btn-edit', function() {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform AJAX request to fetch the record data based on the ID
    $.ajax({
    type: 'GET',
    url: '/pdrrmo/get-userId/' + id, // Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#id').val(response.id);
        console.log()
    },
  error: function(xhr, status, error) {
        // Check if the response status code is 404 (Not Found)
        if (xhr.status === 404) {
            // Show SweetAlert error message with the error response from the server
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error
            });
        } else {
            // Show a generic error message for other types of errors
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the record.'
            });
        }}
});
  });



  $(document).on('click', '.btn-details', function() {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform AJAX request to fetch the record data based on the ID
    $.ajax({
    type: 'GET',
    url: '/pdrrmo/getInfo/' + id, // Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#id-req').text(response.id);
        $('#location').text(response.location || 'N/A');
        $('#population').text(response.population || 'N/A');
        $('#cnumber').text(response.contact_number || 'N/A');
        $('#enumber').text(response.emergency_number || 'N/A');
        $('#municipality_name').text(response.name_municipality);
        // Show the edit modal
        dd(response.name_municipality);
        $('#modalDiscount').modal('show');
    },
  error: function(xhr, status, error) {
        // Check if the response status code is 404 (Not Found)
        if (xhr.status === 404) {
            // Show SweetAlert error message with the error response from the server
            const errorResponse = JSON.parse(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorResponse.errorMessage
            });
        } else {
            // Show a generic error message for other types of errors
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the record.'
            });
        }}
});
  });
</script>


<!--Modal: EDIT-->
 <div class="modal fade right" id="modalReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <h3 class="heading" style="color:white;">Update Request</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

          <!--Body-->
             <div style="margin: 20px;">
              <form action="/pdrrmo/reset-password" method="post"  > 
                  @csrf
                  <div class="form-group">
                    <label class="req-label">Password</label>
                    <input type="hidden" name="id"  id="id" placeholder="Enter First Name" autocomplete="off" value="{{old('first_name') }}" required>
                    <input type="password" name="pass"  id="pass" placeholder="Enter password" autocomplete="off" value="{{old('password') }}" required>
                    @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                  </div>
                     <div class="form-group">
                    <label class="req-label">Confirm Password</label>
                    <input type="password" name="confirmp" id="confirmp"  placeholder="Enter confirm password" autocomplete="off" value="{{old('confirmp') }}" >
                    @error('confirmp')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                  </div> 
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <x-primary-button style="background-color: #2C3B41; color: white;" class="btn">
                    {{ __('Update') }}
                  </x-primary-button>
                </div>
            
             </form>
            </div>
      </div>
    </div>
</div>
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error', // Use 'error' icon for error messages
            title: 'Error',
            text: '{{ session('error') }}'
        });
    </script>
@endif
@if (session('fails'))
    <script>
        Swal.fire({
            icon: 'error', // Use 'error' icon for error messages
            title: 'Error',
            text: '{{ session('error') }}'
        });
    </script>
@endif

      @if(session('success'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Successfuly registered!',
              text: '{{ session('success') }}'
          });
      </script>
      @endif

@if ($errors->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('error') }}',
            onClose: () => {
                // Redirect the user back without closing the modal
                window.location.href = document.referrer;
            }
        });
    </script>
@endif


<!-- Add this script in your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function validatePasswords() {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirmation').val();

        // Check if passwords match
        if (password !== confirmPassword) {
            // Passwords don't match, display alert and return false to prevent form submission
            alert('Passwords do not match!');
            return false;
        }

        // Passwords match, allow form submission
        return true;
    }
    
 function confirmDelete(id) {
    // Show SweetAlert confirmation
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      // If the user confirms the deletion
      if (result.isConfirmed) {
        // Perform the AJAX request to delete the request
        $.ajax({
          type: 'POST',
         url: '/pdrrmo/destroy-account/' + id,  
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function (response) {
            // Display success message
            Swal.fire(
              'Deleted!',
              'The user has been deleted.',
              'success'
            ).then(function () {
              // Reload the page after deletion
              location.reload();
            });
          },
          error: function (error) {
            // Display error message
             console.log(error);
             Swal.fire(
                'Error!',
                'This user cannot be deleted because there are associated records in the system. Please make sure to resolve any dependencies before attempting to delete this user.',
                'error'
                );

          }
        });
      }
    });
  }
</script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Successfully registered!',
        text: '{{ session('success') }}'
    });
</script>
@endif
@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Validation Failed',
                text: '{{ $errors->first() }}',
            });
        });
    </script>
@endif
