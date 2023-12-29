<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>cms dashboard
    </title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
                  <table class="table" id="table-data" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Incident ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Date Needed</th>
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
          
            
       @include('/mdrrmo/footer')
          
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
            <form action="/pdrrmo/insert-assistance" method="post">
              @csrf

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
                <label for="incident_desc">Incident Description:</label>
                <textarea name="incident_desc" id="incident_desc" class="form-control"></textarea>
                @error('incident_desc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="modal-footer">
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
        <h4 class="modal-title">New Ctegory</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form action="/mdrrmo/update-category" method="post">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label class="req-label">Category Name</label>
            <input type="hidden" name="catid" id="catid" placeholder="Enter incident type" autocomplete="off" value="">
            <input type="text" name="cat-name" id="cat-name" class="form-control" placeholder="Enter incident type" autocomplete="off" value="">
            @error('cat-name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
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
