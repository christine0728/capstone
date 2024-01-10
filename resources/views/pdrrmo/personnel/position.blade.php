<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Resquire</title>
    <!-- Include the second CSS file -->
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
                <!----css3---->
          <!-- Include Bootstrap CSS (you can change the version if needed) -->
          <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

          <!-- Include your custom CSS file (if you have one) -->
          <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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
              <div class="card" style="width: 105%;">
                <div class="card-body">
                  <h3>Manage Position</h3><br>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRelatedContent">New Position</button> <p></p>    List of Positions
                  </p>
                  <div class="table-responsive">
                  <table class="table" id="table-data" style="width:100%">
              <thead>
                <tr>
                  <th>Position</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($positions as $position)
               <tr>
                  <td>{{ $position->Position }}</td>
                  <td>{{ $position->description ?? 'none' }}</td>

                  <td> 

                  <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $position->id }}" data-target="#modalEdit">
                  <button type="button" class="btn btn-success btn-xs">
           
                <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
           
                  </button>
                  </a>
                  <a href="#"  onclick="confirmDelete('{{ $position->id }}')">
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
          <br><br><br><br><br><br><br><br>
            
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
<div class="modal fade" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">New Personnel Position</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12" style="margin: 20px;">
            <form action="/pdrrmo/insert-position" method="post">
              @csrf
              <div class="form-group">
                <label class="req-label">Position Name</label>
                <input type="text" name="position" class="form-control col-md-11" placeholder="Enter position" autocomplete="off" value="{{ old('position') }}" required>
                @error('position')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label class="req-label">Description</label>
                <textarea class="form-control" style="width: 91%" name="description" id="update-desc" placeholder="Enter position descriptions" autocomplete="off" value="{{ old('description') }}"></textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="modal-footer d-flex justify-content-end">
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
         url: '/pdrrmo/destroy-position/' + id,  
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
              'You cannot delete the Position. It was in used',
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
    url: '/pdrrmo/get-position/' + id,// Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#position-id').val(response.id);
        $('#position-name').val(response.Position);
        $('#update-desc').val(response.description);
   
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
                text: 'Error occured'
            });
        }}
});
  });
</script>

<div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Update Position</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <form action="/pdrrmo/update-position" method="post">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label class="req-label">Position Name</label>
            <input type="hidden" name="position-id" id="position-id" autocomplete="off" value="">
            <input type="text" name="position-name" id="position-name" class="form-control" placeholder="Enter position" autocomplete="off" value="">
            @error('position-name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label class="req-label">Description</label>
            <textarea class="form-control" style="width: 100%" name="update-desc" id="update-desc" placeholder="Enter position descriptions" autocomplete="off">{{ old('update-desc') }}</textarea>
    
           @error('update-desc')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-end">
   
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button  class="btn btn-primary">
          Save Changes
                </button>
        </div>
      </form>
    </div>
  </div>
</div>

 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
    <!-- Include DataTables library -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- Include DataTables Buttons library -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    
    <!-- Include JSZip library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    
    <!-- Include PDFMake libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    
    <!-- Include Buttons HTML5 library -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    
    <!-- Include Buttons Print library -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  
  <script>
    $(document).ready(function() {
    $('#table-data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
  </script>