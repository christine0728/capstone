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


        <!-- Include Bootstrap CSS (you can change the version if needed) -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

      <!-- Include your custom CSS file (if you have one) -->
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

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
                  <h4 class="card-title">Request</h4></h4>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRelatedContent">Add</button> <p></p>
         
                  <p class="card-description">
                    List of Request
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>Incident</th></th>
                                    <th>Municipality</th>
                                    <th>Location</th>
                                    <th>Date Needed</th>
                                    <th>Date Happened</th>
                                    <th>Incident Description</th>
                                    <th>Comment</th>
                                    <th>Request Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Here you can loop through your data and create rows -->
                                @forelse ($assistance as $request)
                                <tr>
                                    <td>{{ $request->incident_name }}</td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->location }}</td>
                                    <td>{{ $request->date_needed }}</td>
                                    <td>{{ $request->date_happened }}</td>
                                    <td>{{ $request->incident_desc }}</td>
                                    <td>{{ $request->comment }}</td>
                                    <td>{{ $request->req_status }}</td>
                                    <td>  
                                    <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $request->id }}" data-target="#modalEdit">              
                                        <button type="button" class="btn btn-success btn-xs">
                                           <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="#"  onclick="confirmDelete('{{ $request->id }}')">
                                        <button type="button" class="btn btn-danger btn-xs"  >
                                          <i style="color: white; font-size: 12px;" class="fas fa-trash-alt"></i>
                                        </button>
                                    </a>
                                    </td>
                                </tr>
          
                                @empty
                        <tr>
                              <td >No requests found.</td>
                              <td >No requests found.</td>
                              <td >No requests found.</td>
                              <td >No requests found.</td>   
                              <td >No requests found.</td>   
                              <td >No requests found.</td> 
                              <td >No requests found.</td>
                              <td >No requests found.</td>
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
          
            
       @include('/pdrrmo/footer')
          
          </div>
          
        

        </div>
    </div>
<!-- Include jQuery (you can change the version if needed) -->
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>

<!-- Include Popper.js -->
<script src="{{ asset('js/popper.min.js') }}"></script>

<!-- Include Bootstrap JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Include your custom JavaScript file (if you have one) -->
<script src="{{ asset('js/your-custom-script.js') }}"></script>

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
<div class="modal fade" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form action="/pdrrmo/insert-assistance" method="post" onsubmit="return validateForm()">
              @csrf

              <div class="form-group">
                <label for="owner">Select an Municipality:</label>
                <select id="owner" name="owner" class="form-control" required>
                  <option value="" selected disabled>Select an Incident</option>
                  <?php foreach ($owners as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="incident">Select an Incident:</label>
                <select id="incident" name="incident" class="form-control">
                  <option value="" selected disabled>Select an Incident</option>
                  <?php foreach ($incidents as $incident): ?>
                    <option value="<?= $incident['id'] ?>"><?= $incident['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" class="form-control">
                @error('location')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="date_needed">Date Needed:</label>
                <input type="date" name="date_needed" id="date_needed" class="form-control">
                @error('date_needed')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="date_needed">Date Needed:</label>
                <input type="date" name="date_happened" id="date_happened" class="form-control">
                @error('date_happened')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>


              <div class="form-group">
                <label for="incident_desc">Incident Description:</label>
                <textarea name="incident_desc" id="incident_desc" class="form-control"></textarea>
                @error('incident_desc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

      @if(session('success'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('success') }}'
          });
      </script>
            @if(session('updated'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('update') }}'
          });
      </script>
      @endif
      @if(session('message'))
      <script>
          Swal.fire({
              icon: 'success',
              title: 'Successfuly inserted!',
              text: '{{ session('success') }}'
          });
      </script>
@endif
<script>
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
         url: '/mdrrmo/destroy-category/' + id,  
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function (response) {
            // Display success message
            Swal.fire(
              'Deleted!',
              'The request has been deleted.',
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
              'An error occurred while deleting the item.',
              'error'
            );
          }
        });
      }
    });
  }

  $(document).on('click', '.btn-edit', function() {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform AJAX request to fetch the record data based on the ID
    $.ajax({
    type: 'GET',
    url: '/mdrrmo/get-category/' + id,// Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#cat-name').val(response.name);
        $('#catid').val(response.id);
        $('#modalDiscount').modal('show');
    },
  error: function(xhr, status, error) {
        // Check if the response status code is 404 (Not Found)
        if (xhr.status === 404) {
            // Show SweetAlert error message with the error response from the server
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'dd'
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title">New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form action="/mdrrmo/update-category" method="post">
        <div class="modal-body">
          @csrf
          <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" class="form-control">
                @error('location')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="date_needed">Date Needed:</label>
                <input type="date" name="date_needed" id="date_needed" class="form-control">
                @error('date_needed')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="date_needed">Date happened:</label>
                <input type="date" name="date_happened" id="date_happened" class="form-control">
                @error('date_happened')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="incident_desc">Incident Description:</label>
                <textarea name="incident_desc" id="incident_desc" class="form-control"></textarea>
                @error('incident_desc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
        </div>

        <div class="modal-footer d-flex justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="updateRecord" class="btn btn-primary" style="background-color: #2C3B41; color: white;">
            Update Category
          </button>
        </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>

<script>
  function validateForm() {
    // Get the values of the selects
    var ownerValue = document.getElementById('owner').value;
    var incidentValue = document.getElementById('incident').value;

    // Check if the values are empty (or any other condition you want to enforce)
    if (ownerValue === '' || incidentValue === '') {
      alert('Please select values for both Municipality and Incident.');
      return false; // Prevent the form from submitting
    }

    return true; // Allow the form to submit
  }
</script>