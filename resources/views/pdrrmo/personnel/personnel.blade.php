<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Personnel
    </title>
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
                  <h3>Manage Personnel</h3><br>
                  <form action="/pdrrmo/filter-personnel" method="get" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date: </label>
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <div class="form-group">
                          <label for="end_date">End Date: </label>
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>
                      &nbsp;

                      <button type="submit" class="btn btn-primary">Apply Filter</button>&nbsp;
                      <a href="/pdrrmo/personnel" class="btn btn-secondary">All</a>
                  </form> <br>
                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modalRelatedContent">New Personnel</button>  </p>
                  <div class="table-responsive">
                  <table class="table" id="table-data" style="width:100%">
                  <thead>
                <tr>
                  <th>FullName</th>
                  <th>Contact Number</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($personnels as $personnel)
                <tr>
            
                  <td>{{ $personnel->full_name}}</td>
                  <td>{{ $personnel->contact_number}}</td>
                  <td>{{ $personnel->email}}</td>
                  <td>{{ $personnel->address }}</td>
                  <td>{{ date('F d, Y g:ia', strtotime($personnel->created_at)) }}</td>
                  <td> 
                  <a href="#" class="btn-edit" data-toggle="modal"  data-id="{{ $personnel->id }}" data-target="#modalEdit" >
                  <button type="button" class="btn btn-success btn-xs">
           
                <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
           
                  </button>
                  </a>
              
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

@if(session('success'))
<script>

    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}'
    });
</script>
@endif

@if(session('error'))
<script>

    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('susssssccess') }}'
    });
</script>
@endif
</main>
</body>
</html>
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
   url: '/pdrrmo/destroy-personnel/' + id,   
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
      Swal.fire(
        'Error!',
        'An error occurred while deleting the request.',
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
url: '/pdrrmo/get-personnel/' + id, // Replace '/get-record/' with the correct URL from your routes file
dataType: 'json',
success: function(response) {
  var positionName = response.position_name;
  console.log(positionName);
  $('#position option').filter(function() {
            return $(this).text() === positionName;
        }).prop('selected', true);
  var departmentName = response.department_name;
  $('#department option').filter(function() {
            return $(this).text() === departmentName;
        }).prop('selected', true);
  //Update the modal fields with the fetched data
  $('#id').val(response.id);
  $('#first_name').val(response.first_name);
  $('#middle_name').val(response.middle_name);
  $('#last_name').val(response.last_name);
  $('#suffix').val(response.suffix);
  $('#contact_number').val(response.contact_number);
  $('#email').val(response.email);
  $('#address').val(response.address);
  $('#date_of_birth').val(response.date_of_birth);
  $('#date_of_hire').val(response.date_of_hire);
  $('#emergency_contact_name').val(response.emergency_contact_name);
  $('#emergency_contact_number').val(response.emergency_contact_number);
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
      var errorMessage = "An error occurred while fetching the record.";
    if (xhr.responseJSON && xhr.responseJSON.message) {
      errorMessage = xhr.responseJSON.message;
    }

    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: errorMessage
    });
  }}
});
});
</script>


<div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="updatePersonnelModalLabel">Update Personnel Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Personnel information update form -->
                <form action="/pdrrmo/update-personnel" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                    <div class="form-group">
                        <label class="req-label">First Name</label>&nbsp;*
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" autocomplete="off" value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter Middle Name" autocomplete="off" value="{{ old('middle_name') }}">
                        @error('middle_name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Last Name</label>&nbsp;*
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" autocomplete="off" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Suffix</label>
                        <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Jr. Sr." autocomplete="off" value="{{ old('suffix') }}">
                        @error('suffix')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="req-label">Select a Position:</label>
                      <select id="position" name="position" class="form-control">
                        <option value="" selected disabled>Select a position</option>
                        <?php foreach ($positions as $position): ?>
                            <option value="<?= $position['id'] ?>"><?= $position['Position'] ?></option>
                        <?php endforeach; ?>
                    </select>

                      @error('category')
                      <div class="text-red-600 text-sm">{{ $message }}</div><br>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Contact Number</label> &nbsp;*
                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number" autocomplete="off" value="{{ old('contact_number') }}">
                        @error('contact_number')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Email</label>&nbsp;*
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" autocomplete="off" value="{{ old('email') }}">
                        @error('email')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" autocomplete="off" value="{{ old('address') }}">
                        @error('address')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="req-label">Select a Department:</label>
                      <select id="department" name="department" class="form-control">
                        <option value="" selected disabled>Select a Department</option>
                        
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
                        <?php endforeach; ?>
                    </select>
                      @error('department')
                      <div class="text-red-600 text-sm">{{ $message }}</div><br>
                      @enderror
                   </div>
                    <div class="form-group">
                        <label class="req-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Enter Date of Birth" autocomplete="off" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Date Hired</label>
                        <input type="date" name="date_of_hire" id="date_of_hire" class="form-control" placeholder="Enter Date Hired" autocomplete="off" value="{{ old('date_of_hire') }}">
                        @error('date_of_hire')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" id="emergency_contact_number" class="form-control" placeholder="Enter Emergency Contact Number" autocomplete="off" value="{{ old('emergency_contact_number') }}">
                        @error('emergency_contact_number')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal: modalRelatedContent-->


<div class="modal fade right" id= "modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title " style="color: white;">Personnel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pdrrmo/insert-personnel" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                    <div class="form-group">
                        <label class="req-label">First Name</label><span class="text-danger">*</span>
                        <input type="hidden" name="id" id="id" placeholder="Enter First Name" autocomplete="off" value="{{old('first_name')}}" required>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" autocomplete="off" value="{{old('first_name')}}" required>
                        @error('first_name')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter Middle Name" autocomplete="off" value="{{old('middle_name')}}">
                        @error('middle_name')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Last Name</label><span class="text-danger">*</span>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" autocomplete="off" value="{{old('last_name')}}" required>
                        @error('last_name')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Suffix</label>
                        <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Jr. Sr." autocomplete="off" value="{{old('suffix')}}">
                        @error('suffix')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="req-label">Select a Position:</label>
                      <select id="position" name="position" class="form-control">
                        <option value="" selected disabled>Select a position</option>
                        
                        <?php foreach ($positions as $position): ?>
                            <option value="<?= $position['id'] ?>"><?= $position['Position'] ?></option>
                        <?php endforeach; ?>
                    </select>
                      @error('category')
                      <div class="text-sm" style="color: red;">{{ $message }}</div>
<br>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Contact Number</label><span class="text-danger">*</span>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number" autocomplete="off" value="{{old('contact_number')}}">
                        @error('contact_number')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Email</label><span class="text-danger">*</span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" autocomplete="off" value="{{old('email')}}">
                        @error('email')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Address</label><span class="text-danger">*</span>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" autocomplete="off" value="{{old('address')}}">
                        @error('address')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="req-label">Select a Department:</label>
                      <select id="department" name="department" class="form-control">
                        <option value="" selected disabled>Select a Department</option>
                        
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
                        <?php endforeach; ?>
                    </select>
                      @error('department')
                      <div class="text-sm" style="color: red;">{{ $message }}</div>
<br>
                      @enderror
                   </div>
                    <div class="form-group">
                        <label class="req-label">Date of birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Enter Birth date" autocomplete="off" value="{{old('date_of_birth')}}">
                        @error('date_of_birth')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Date Hired</label>
                        <input type="date" name="date_of_hire" id="date_of_hire" class="form-control" placeholder="Enter Date Hired" autocomplete="off" value="{{old('date_of_hire')}}">
                        @error('date_of_hire')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" placeholder="Enter Emergency Name" autocomplete="off" value="{{old('emergency_contact_name')}}">
                        @error('emergency_contact_name')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="req-label">Emergency Contact Number</label>
                        <input type="number" name="emergency_contact_number" id="emergency_contact_number" class="form-control" placeholder="Enter Emergency Contact" autocomplete="off" value="{{old('emergency_contact_number')}}">
                        @error('emergency_contact_number')
                        <div class="text-sm" style="color: red;">{{ $message }}</div>

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
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="/insert-request" method="post" > 
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h3 class="modal-title" id="exampleModalLabel">New Request</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="true">&times;</span>
    </button>
  </div><div class="modal-body">
    @csrf
    <div class="form-group">
      <label class="req-label">Incident Type</label>
      <input type="text" name="incident_type" placeholder="Enter incident type" autocomplete="off" value="{{old('incident_type') }}">
      @error('incident_type')
      <div class="text-red-600 text-sm">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label class="req-label">Location</label>
      <input type="text" name="location" placeholder="Enter location" autocomplete="off" value="{{ old('location')}}">
      @error('location')
      <div class="text-red-600 text-sm">{{ $message }}</div><br>
      @enderror
    </div>
    <div class="form-group">
      <label class="req-label">Severity</label>
      <select name="severity">
        <option> Select</option>
        <option>level 1</option>
        <option>level 2</option>
        <option>level 3</option>
      </select><br>
      @error('severity')
      <div class="text-red-600 text-sm">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label class="req-label">Incident description</label>
      <input type="text" name="incident_desc" placeholder="Enter incident description" autocomplete="off" value="{{ old('incident_desc') }}"><br>
      @error('incident_desc')
      <div class="text-red-600 text-sm">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label class="req-label">Resource needed</label>
      <input type="text" name="resource_need" placeholder="Enter resource need" autocomplete="off" value="{{ old('resource_need') }}"><br>
      @error('resource_need')
      <div class="text-red-600 text-sm">{{ $message }}</div>
      @enderror
    </div>
  <div class="modal-footer">

      
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <x-primary-button style="background-color: #2C3B41; color: white;" class="btn">
      {{ __('Sent Request') }}
    </x-primary-button>
  </div>
</div>
</div>
</form>
</div>
@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Successfully inserted!',
  text: '{{ session('success') }}'
});
</script>
@endif
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