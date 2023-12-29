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
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Supplier</h4>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">New Supplier</button>

     
                  <p class="card-description">
                    List of memo
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                    <thead>
                <tr>
                  <th>Supplier Name/Donor</th>
                  <th>Contact Number</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($suppliers as $supplier)
                <tr>
                  <td>{{  $supplier->name }}</td>
                  <td>{{  $supplier->contact}}</td>
                  <td>{{  $supplier->address}}</td>  
                  <td> 
                      <a href="#" class="btn-edit" data-toggle="modal"  data-id="{{ $supplier->id }}" data-target="#modalEdit" ><i style="color:green;" class="fa fa-edit"></i></a>
                      <a href="#" onclick="confirmDelete('{{ $supplier->id }}')"><i style="color:RED;" class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                @empty
                <tr>
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
<!--Modal: modalRelatedContent-->
<div class="modal fade right" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h4 class="modal-title">New Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="margin: 20px;">
                        <form action="/mdrrmo/insert-supplier" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="req-label">Supplier Name</label>
                                <input type="hidden" name="supplier-id" id="supplier-id" value="">
                                <input type="text" name="supplier-name" id="supplier-name" placeholder="Enter supplier name" autocomplete="off" value="" class="form-control">
                                @error('supplier-name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="req-label">Supplier Contact</label>
                                <textarea id="contact" name="contact" placeholder="Enter supplier contact" autocomplete="off" value="" class="form-control"></textarea>
                                @error('contact')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="req-label">Supplier Address</label>
                                <input type="text" name="address" id="address" placeholder="Enter supplier address" autocomplete="off" value="" class="form-control">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <x-primary-button style="background-color: #2C3B41; color: white;">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade right" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title">New Assistance request</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/mdrrmo/insert-supplier" method="post">
                @csrf
                <div class="modal-body">
                <div class="form-group">
                                <label class="req-label">Supplier Name</label>
                                <input type="hidden" name="supplier-id" id="supplier-id" value="">
                                <input type="text" name="supplier-name" id="supplier-name" placeholder="Enter supplier name" autocomplete="off" value="" class="form-control">
                                @error('supplier-name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="req-label">Supplier Contact</label>
                                <textarea id="contact" name="contact" placeholder="Enter supplier contact" autocomplete="off" value="" class="form-control"></textarea>
                                @error('contact')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="req-label">Supplier Address</label>
                                <input type="text" name="address" id="address" placeholder="Enter supplier address" autocomplete="off" value="" class="form-control">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title">Update Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/mdrrmo/update-supplier" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supplierName" class="req-label">Supplier Name</label>
                        <input type="hidden" name="supplierId" id="supplierId" value="">
                        <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Enter supplier name" value="">
                        @error('supplier-name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplierContact" class="req-label">Supplier Contact</label>
                        <textarea class="form-control" id="supplier-contact" name="supplier-contact" placeholder="Enter supplier contact"></textarea>
                        @error('contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplierAddress" class="req-label">Supplier Address</label>
                        <input type="text" class="form-control" id="supplier-address" name="supplier-address" placeholder="Enter supplier address" value="">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
          url: '/mdrrmo/destroy-supplier/' + id, 
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
              'You cannot delete the supplier. It was already in use.',
              'error'
            );
          }
        });
      }
    });
  }



  // JavaScript function to handle form submission
  function updateRecord(id) {
    // Get the form data
    var formData = {
      field1: $('#incidenttype').val(),
      field2: $('#loca').val(),
      field3: $('severity-label').val(),
      field4: $('desc').val(),
      field5: $('resource').val(),
      _token: $('input[name="_token"]').val()
    };

    // Perform AJAX request to update the record
    $.ajax({
      type: 'POST',
    
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Show SweetAlert success message
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Record updated successfully!'
        }).then(function() {
          // Reload the page to update the view with the new data
          location.reload();
        });
      },
      error: function(error) {
        // Show SweetAlert error message
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while updating the record.'
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
     url: '/mdrrmo/get-supplier/' + id, // Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#supplierId').val(response.id);
        $('#supplierName').val(response.name);
        $('#supplier-contact').val(response.contact);
        $('#supplier-address').val(response.address);
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