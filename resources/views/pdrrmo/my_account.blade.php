<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Resquire</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
      <!----css3---->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
  
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    
  </head>

  <body>

<div class="wrapper">


<div class="body-overlay"></div>

@include('/pdrrmo/nav')

        <!-- Page Content  -->
        <div id="content">
 @include('/pdrrmo/header')
   
      
      <div class="main-content">
 
     
<div class="page-content page-container" id="page-content">

<div class="row container d-flex justify-content-center">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                
                  <div class="table-responsive">
                  <div class="container">
    <div class="main-body">  
      <h3>My Account</h3><br>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <form id="form1" runat="server" method="post" action="/pdrrmo/update-logo" enctype="multipart/form-data">
                                     @csrf
                        @forelse ($users as $user)
                        @if ($user->image)
                                <img src="{{ asset('uploads/logo/' . $user->image) }}" alt="Admin" class="rounded-circle" width="150" id="logo">
                            @else
                                <img src="{{ asset('uploads/logo/logo.png') }}"alt="Admin" class="rounded-circle" width="150" id="logo" id="logo">
                            @endif
                        @empty
                             <img src="{{ asset('uploads/logo/logo.png') }}" width="50px" height="50px" id="logo" class="logo">
                        @endforelse
                        <p></p>
                        <center><div class="custom-file">
    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="readURL(this);">
    <label class="custom-file-label" for="image">Choose file</label>
</div>
</center> <p></p>
                             <x-primary-button id="updateRecord" style="background-color: #2C3B41; color: white;" class="btn">
                                {{ __('Update Logo') }}
                              </x-primary-button> 
                      </form>
                    <div class="mt-3">
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
              <form action="/pdrrmo/insert-info" method="post">
                        @csrf
                        <!-- Form Row-->
                         @forelse ($users as $user)
                <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                      <h6 class="mb-0">Officer </h6></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="officer" name="officer" type="text" placeholder="Enter officer" value="{{$user->officer}}" >
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Municipality</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="municipality" name="municipality" type="text" placeholder="Enter Municipality" readonly value="{{$user->name}}" >
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="email" name="email" type="text" placeholder="" value="{{$user->email}}"readonly>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="location" name="location" type="text" placeholder="Enter your Location" value="{{$user->location}}">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Population</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="population" name="population" type="text" placeholder="Enter your population" value="{{$user->population}}">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="cnumber" name="cnumber" type="text" placeholder="Enter contact number" value="{{$user->contact_number}}">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Emergency Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" id="enumber" name="enumber" type="text" placeholder="Enter Emergency Contact Number" value="{{$user->emergency_number}}">
                    </div>
                  </div>
                  <hr>
                 
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Save</button>

                     </div>
                  </div>
                </div>
              </div>
            </form>
              @empty 
                          @endforelse


              </div>
            </div>

          </div>
      </div>
                  </div>
                </div>
              </div>
            </div>
            
            </div>
  
            </div>
          
            
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
      
       $('.more-button,.body-overlay').on('click', function () {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });
      
        }); 
</script>
</body>
</html>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
      @if(session('success'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Success!',
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