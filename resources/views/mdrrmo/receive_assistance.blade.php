<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Resquire</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Font Awesome CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

            <!-- Include Bootstrap CSS (you can change the version if needed) -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<!-- Include your custom CSS file (if you have one) -->
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

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
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
                  <h3>Received Request</h3><br>
                  <p class="card-description">
                    List of Request
                  </p>
                  <form action="/mdrrmo/filter-req" method="get" class="form-inline">
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
                      <a href="/mdrrmo/receive-assistance" class="btn btn-secondary">All</a>
                  </form> <br>
                  <div class="table-responsive">
                
                  <table class="table" id="table-data">
                    <thead>
                        <tr>
                            <th>Municipality</th>
                            <th>Report</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                        <tr style="{{ $notificationId == $report->id ? 'background-color: #8fd3f3;' : '' }}">
   
                            <td>{{ $report->user_name }} </td>
                            <td>{{ $report->report_name }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->incident_desc }}</td>
                            <td>
                              <span class="status-req" style="background-color:
                                  @if($report->req_status === 'Pending' && $report->referral_status === 'Referred')
                                      #007bff;
                                  @elseif($report->req_status === 'Pending')
                                      #ffdd76;
                                  @elseif($report->req_status === 'Accepted')
                                      #219b54;
                                  @elseif($report->req_status === 'Declined')
                                      #e4423c;
                                  @endif
                                  ; padding: 5px; border-radius: 10px;">
                                  @if($report->referral_status === 'Referred' && $report->req_status === 'Pending')
                                      Referred
                                  @else
                                      {{ $report->req_status }}
                                  @endif
                              </span>
                          </td>
                            <td>{{ date('F d, Y g:ia', strtotime($report->created_at)) }}</td>
        
                              <td>
                              <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $report->id }}" data-target="#modalDetails">
                              <button type="button" class="btn btn-primary mr-2 rounded">

                                      <i style="color: white; font-size: 12px;" class="fa fa-eye"></i>
                                  </button>
                              </a>
                              @if($report->referral_status == 'Referred')
                                <a href="#" class="btn-history" data-toggle="modal" data-id="{{ $report->id }}" data-target="#modalReferralHistory">
                                    <button type="button" class="btn btn-info rounded">
                                        <i style="color: white; font-size: 12px;" class="fa fa-history"></i>
                                    </button>
                                </a>&nbsp;
                                <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $report->id }}" data-target="#modalStatus">
                                  <button type="button" class="btn btn-success rounded">
                                      <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                  </button>
                              </a>
                                
                                @else
                                <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $report->id }}" data-target="#modalStatus">
                                  <button type="button" class="btn btn-success rounded">
                                      <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                  </button>
                              </a>
                                @endif
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

<div class="modal fade" id="modalReferralHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-lg modal-side modal-bottom-right modal-notify modal-primary" role="document">
        <!-- Content -->
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">
                    <i class="fas fa-history mr-2"></i> Referral History
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="request-id" name="request-id">
                <ul class="list-group">
                    <!-- Append referral history items here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
        <!-- /.Content -->
    </div>
</div>

<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Update</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form action="/mdrrmo/update-receive-assistance" method="post" onsubmit="return validateForm()">
        <div class="modal-body">
          @csrf
          <input type="hidden" id="userid" name="userid">
          <input type="hidden" id="id-req" name="id-req">
          
          <div class="form-group">
            <label for="incident">Select Response:</label>
            <select id="status-req" name="status-req" class="form-control" onchange="toggleReferToField()">
              <option value="" selected disabled>Select reponse</option>
              <option value="Accepted">Accepted</option>
              <option value="Pending">Refer to other office</option>
            </select>
          </div>

          <div class="form-group" id="referToField" style="display: none;">
            <label for="owner">Refer To:</label>
            <select id="owner" name="owner" class="form-control">
                <option value="" selected disabled>Select Office</option>
            </select>
        </div>

          <div class="form-group">
            <label for="comment">Message:</label>
            <textarea class="form-control" style="width: 100%" name="message" id="message" placeholder="Response..." autocomplete="off">{{ old('comment') }}</textarea>
            @error('notes')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="modal-footer d-flex justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="updateRecord" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
    <!--/.Content-->
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
    url: '/mdrrmo/get-request/' + id,// Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
      var formattedDate = response.update_req_status
              ? new Date(response.update_req_status).toLocaleString('en-US', { 
                  year: 'numeric', 
                  month: 'long', 
                  day: 'numeric',
                  hour: 'numeric',
                  minute: 'numeric',
                  hour12: true  // Use 12-hour clock format
              })
              : 'Still pending';
              var status = response.req_status;
              console.log(status);

              if (status !== 'Pending') {
                  $('#status-req option').filter(function() {
                      return $(this).text() === status;
                  }).prop('selected', true);
              }
              var requestorId = response.userId;
              var ownerId = response.ownerId;
              generateDropdownOptions(requestorId, ownerId);
        //Update the modal fields with the fetched data
            $('#locationName').val(response.location);
            $('#userid').val(response.userId);
            $('#comment').val(response.comment);
            $('#locationLabel').text(response.location);
            $('#requestorid').text(response.userId);
            $('#id-req').val(response.id);
            $('#dateHappened').val(response.date_happened);
            $('#dateNeeded').val(response.date_needed);
            $('#incidentDesc').val(response.incident_desc);
            $('#actionTaken').val(response.action_taken);
            $('#ownerLabel').text(response.owner_name);
            $('#incidentLabel').text(response.incident_name);
            $('#dateHappenedLabel').text(response.date_happened);
            $('#dateNeededLabel').text(response.date_needed);
            $('#incidentDescLabel').text(response.incident_desc);
            $('#actionTakenLabel').text(response.action_taken);
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
<script type="text/javascript">
  $(document).on('click', '.btn-history', function() {
    var requestId = $(this).data('id');

    $.ajax({
        type: 'GET',
        url: '/mdrrmo/get-referral-history/' + requestId,
        dataType: 'json',
        success: function(response) {
            updateModalContent(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle errors, show an alert, or provide user feedback
        }
    });
});

function updateModalContent(response) {
    var modalBody = $('#modalReferralHistory .modal-body ul');
    modalBody.empty(); // Clear any previous content

    if (response.length > 0) {
        var isFirstRecord = true;  // Declare outside the loop

        // Iterate through the response and append data to the modal
        $.each(response, function(index, referral) {
            var referredByName = referral.referred_by_name;
            var referredToName = referral.referred_to_name;
            var status = isFirstRecord ? "[ " + referral.status + " ]" : '';

            var formattedDate = new Date(referral.createddate);
            var dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
            var formattedDateString = formattedDate.toLocaleDateString(undefined, dateOptions);

            var formattedTimeString = formattedDate.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });

            var iconClass = index === 0 ? 'fas fa-arrow-alt-circle-up mr-2' : '';
            var textClass = index === 0 ? 'text-success' : '';

            modalBody.append(
                '<li class="list-group-item ' + textClass + '">' +
                '<i class="' + iconClass + '"></i>' +
                formattedDateString + ' at ' + formattedTimeString + ': ' +
                referredByName + ' referred to ' + referredToName +
                ' <span style="color: black; font-size: 12px;"> ' + status + ' </span></li>'
            );

            // Update the flag after processing the first record
            if (isFirstRecord) {
                isFirstRecord = false;
            }
        });
    } else {
        modalBody.append('<li class="list-group-item">No referral history found.</li>');
    }
}

</script>

<script>
  function toggleReferToField() {
    var referToField = document.getElementById('referToField');
    var statusReq = document.getElementById('status-req');

    // Show/hide "Refer To" field based on selected option
    if (statusReq.value === 'Pending') {
      referToField.style.display = 'block';
    } else {
      referToField.style.display = 'none';
    }
  }
  function generateDropdownOptions(requestorId, ownerId) {
    // Clear existing options
    $('#owner').empty();

    // Dynamically generate options based on the requestor ID
    @forelse ($owners as $user)
        var userId = "{{ $user->id }}";
        if (userId != requestorId && userId != ownerId) {
            $('#owner').append('<option value="' + userId + '">' + '{{ $user->name }}' + '</option>');
        }
    @empty
    @endforelse;
  }
</script>

<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">View Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12">

            <div class="form-group">
              <label for="incident" style="font-weight: bold;">Incident:</label>
              <label id="incidentLabel"></label>
            </div>
            <div class="form-group">
              <label for="incidentDesc" style="font-weight: bold;">Incident Description:</label>
              <label id="incidentDescLabel"></label>
            </div>
            <div class="form-group">
              <label for="location" style="font-weight: bold;">Location:</label>
              <label id="locationLabel"></label>
            </div>

            <div class="form-group">
              <label for="dateHappened" style="font-weight: bold;">Date Happened:</label>
              <label id="dateHappenedLabel"></label>
            </div>

            <div class="form-group">
              <label for ="dateNeeded" style="font-weight: bold;">Date Needed:</label>
              <label id="dateNeededLabel"></label>
            </div>

          

            <div class="form-group">
              <label for="actionTaken" style="font-weight: bold;">Action Taken:</label>
              <label id="actionTakenLabel"></label>
            </div>


            <div class="modal-footer d-flex justify-content-end">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-edit').click(function() {
      var reportId = $(this).data('id');
      $('#id').val(reportId);
    });
  });
</script>
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
  <script>
    function validateForm() {
        var selectedValue = document.getElementById("status-req").value;
        if (selectedValue === "") {
            alert("Please select a response");
            return false;
        }
        // Additional custom validation logic can be added here if needed
        return true;
    }
</script>