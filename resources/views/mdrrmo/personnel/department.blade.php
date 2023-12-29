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
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    
  </head>

  <body>

<div class="wrapper">


<div class="body-overlay"></div>

@include('/mdrrmo/nav')

        <!-- Page Content  -->
        <div id="content">
 @include('/mdrrmo/header')
   
      
      <div class="main-content">
      
<div class="page-content page-container" id="page-content">

<div class="row container d-flex justify-content-center">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="width: 105%">
                <div class="card-body">
                  <h3>Manage Department</h3><br>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRelatedContent">New Department</button> <p></p>    List of Department
                  </p>
                  <div class="table-responsive">
                  <table class="table" id="table-data" style="width:100%">
              <thead>
                <tr>
                  <th>Department</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($departments as $department)
               <tr>
                  <td>{{ $department->department}}</td>
                  <td>{{ $department->description}}</td>
                  <td> 

                  <a href="#" class="btn-edit" data-toggle="modal"  data-id="{{ $department->id }}" data-target="#modalEdit">
                  <button type="button" class="btn btn-success btn-xs">
           
                <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
           
                  </button>
                  </a>
                  <a href="#"  onclick="confirmDelete('{{  $department->id }}')">
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
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Add department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12" style="margin: 20px;">
          <form action="/mdrrmo/insert-department" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="department" class="req-label">Department</label>
                                <input type="text" name="department" class="form-control col-md-11" placeholder="Enter department" autocomplete="off" value="{{ old('department') }}" required>
                                @error('department')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="req-label">Description</label>
                                <input type="text" name="description" id="description" class="form-control col-md-11" placeholder="Enter department description" autocomplete="off" value="{{ old('description') }}" required>
                                @error('description')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
              <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
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
         url: '/mdrrmo/destroy-department/' + id,  
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
              'You cannot delete the department. It was in used',
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
    url: '/mdrrmo/get-department/' + id,// Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#department-id').val(response.id);
        $('#department-name').val(response.department);
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
        <h4 class="modal-title">Update Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <form action="/mdrrmo/update-department" method="post" >
           <div class="modal-body">
                  @csrf
            <div class="form-group">
              <label class="req-label">Department </label>
              <input type="hidden" name="department-id" id="department-id" autocomplete="off" value="">
              <input type="text" name="department-name" id="department-name" placeholder="Enter department " autocomplete="off" value="">
              @error('department-name')
              <div class="text-red-600 text-sm">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label class="req-label">Description</label>
             
              <input type="text" name="update-desc" id="update-desc" placeholder="Enter position description" autocomplete="off" value="">
              @error('update-desc')
              <div class="text-red-600 text-sm">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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