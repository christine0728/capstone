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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

            <!-- Include Bootstrap CSS (you can change the version if needed) -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<!-- Include your custom CSS file (if you have one) -->
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

      <!----css3---->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">



      <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  </head>


  <body>

<div class="wrapper">
@php
    $notificationId = session('notificationId');
@endphp  

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
                  <h3>Assistance Request</h3><br>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRelatedContent">Request</button> <p></p>
         
                  <p class="card-description">
                    List of Request {{$notificationId}}
                  </p>
                  
                  <form action="/mdrrmo/filter-assistance" method="get" class="form-inline">
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
                      <a href="/mdrrmo/request-assistance" class="btn btn-secondary">All</a>
</form> <br>
                  <div class="table-responsive">
                  <table class="table" id="table-data">
                  <thead>
                      <tr>
                          <th>Incident</th>
                          <th>Requested to</th>
                          <th>Location</th>
                          <th>Date responded</th>
                          <th>Responds</th>
                          <th>Request Status</th>
                          <th>Date Created</th>
                          <th style="width: 160px;">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Here you can loop through your data and create rows -->
                      @forelse ($assistance as $request)
                      <tr style="{{ $notificationId == $request->id ? 'background-color: #8fd3f3;' : '' }}">
                          <td>{{ $request->incident_name }}</td>
                          <td>{{ $request->name }}</td>
                          <td>{{ $request->location }}</td>
                          <td>{{ $request->update_req_status
                                ? date('F d, Y g:ia', strtotime($request->update_req_status))
                                : 'Waiting for Respond'
                            }}
                            </td>
                          <td>{{ $request->comment }}</td>
                          <td>
                              <span class="status-req" style="background-color:
                                  <?php if ($request->req_status === 'Pending'): ?>
                                      #ffdd76;
                                  <?php elseif ($request->req_status === 'Accepted'): ?>
                                      #219b54;
                                  <?php elseif ($request->req_status === 'Declined'): ?>
                                      #e4423c;
                                  <?php endif;
                                  ?> padding: 5px; /* Adjust the padding value as needed */
                                  border-radius: 10px; /* Adjust the border radius value as needed */
                              "> {{ $request->req_status }}</span>
                          </td>
                          <td>{{ date('F d, Y H:i:s', strtotime($request->created_at)) }}</td>

                          <td>
                              <div class="btn-group" role="group">
                              <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $request->id }}" data-target="#modalDetails">
                                      <button type="button" class="btn btn-primary btn-xs btn-sm">
                                          <i style="color: white; font-size: 12px;" class="fa fa-eye"></i>
                                      </button>
                                  </a>&nbsp;
                                  <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $request->id }}" data-target="#modalEdit">
                                      <button type="button" class="btn btn-success btn-xs btn-sm">
                                          <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                      </button>
                                  </a>&nbsp;
                                  <!-- @if($request->req_status == 'Accepted')
                                  @else
                                    <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $request->id }}" data-target="#modalStatus">
                                      <button type="button" class="btn btn-success rounded">
                                          <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                      </button>
                                    </a>
                                  @endif&nbsp; -->
                               
                                @if ($request->req_status !== 'Accepted' && $request->req_status !== 'Declined')
                                    <a href="#" onclick="confirmDelete('{{ $request->id }}')" class="btn btn-danger btn-xs btn-sm">
                                        <i style="color: white; font-size: 12px;" class="fas fa-trash-alt"></i>
                                    </a>&nbsp;
                                @else
                                @endif
                                @if($request->referral_status == 'Referred')
                                <a href="#" class="btn-history" data-toggle="modal" data-id="{{ $request->id }}" data-target="#modalReferralHistory">
                                    <button type="button" class="btn btn-info btn-xs btn-sm">
                                        <i style="color: white; font-size: 12px;" class="fa fa-history"></i>
                                    </button>
                                </a>
                                @else
                                @endif
                              </div>
                          </td>
                          
                      </tr>
                      @empty
                      <tr>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
                          <td>No requests found.</td>
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
<!-- Include jQuery (you can change the version if needed) -->
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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

<div class="modal fade" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form action="/mdrrmo/insert-assistance" method="post" onsubmit="return validateForm()">
              @csrf

              <div class="form-group">
                <label for="owner">Select Office:</label><span class="text-danger">*</span>
                <select id="owner" name="owner" class="form-control">
                  <option value="" selected disabled>Select office</option>
                  <?php foreach ($owners as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="incident">Select Incident:</label><span class="text-danger">*</span>
                <select id="incident" name="incident" class="form-control">
                  <option value="" selected disabled>Select Incident</option>
                  <?php foreach ($incidents as $incident): ?>
                    <option value="<?= $incident['id'] ?>"><?= $incident['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="incident">Select severity:</label><span class="text-danger">*</span>
                <select id="severity" name="severity" class="form-control">
                  <option value="" selected disabled>Select severity</option>
                  <?php foreach ($severities as $severity): ?>
                    <option value="<?= $severity['id'] ?>"><?= $severity['name'] ?></option>
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
                <label for="date_needed">Action Taken:</label>
                <input type="text" name="action_taken" id="action_taken" class="form-control">
                @error('action_taken')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

  
              <div class="form-group">
                  <label for="date_happened">Date Happened:</label>
                  <input type="datetime-local" name="date_happened" id="date_happened" class="form-control">
                  @error('date_happened')
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

              <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Request Now</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>



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
              <label for="incidentDesc" style="font-weight: bold;">Additional Information:</label>
              <label id="incidentDescLabel"></label>
            </div>
            <div class="form-group">
              <label for="incident" style="font-weight: bold;">Severity:</label>
              <label id="severityLabel"></label>
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

      @if(session('success'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('success') }}'
          });
      </script>
      @endif
      @if(session('updated'))
      <script>

          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('updated') }}'
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
         url: '/mdrrmo/destroy-request/' + id,  
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

  $(document).on('click', '.btn-edit', function() {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform an AJAX request to fetch the record data based on the ID
    $.ajax({
        type: 'GET',
        url: '/mdrrmo/get-request/' + id, // Replace with the correct URL from your routes file
        dataType: 'json',
        success: function(response) {
          var severity = response.severity_name
            $('#locationName').val(response.location);
            $('#locationLabel').text(response.location);
            $('#id').val(response.id);
            $('#dateHappened').val(response.date_happened);
            $('#dateNeeded').val(response.date_needed);
            $('#incidentDesc').val(response.incident_desc);
            $('#actionTaken').val(response.action_taken);
            $('#ownerLabel').text(response.name);
            $('#log').text(response.logs);
            $('#incidentLabel').text(response.incident_name);
            $('#severity option').filter(function() {
            return $(this).text() === severity;
        }).prop('selected', true);
            // Assuming response.date_happened and response.date_needed are in the format 'YYYY-MM-DD'
           

            var optionsWithTime = { year: 'numeric', month: 'long', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            var optionsWithoutTime = { year: 'numeric', month: 'long', day: '2-digit' };
            $('#severityLabel').text(response.severity_name);
            var dateHappenedLabel = $('#dateHappenedLabel');
var dateNeededLabel = $('#dateNeededLabel');

// Check if dateHappened is not null or undefined
dateHappenedLabel.text(response.date_happened ? new Date(response.date_happened).toLocaleDateString('en-US', optionsWithTime) : 'none reported');

// Check if dateNeeded is not null or undefined
dateNeededLabel.text(response.date_needed ? new Date(response.date_needed).toLocaleDateString('en-US', optionsWithTime) : 'none reported');

            $('#incidentDescLabel').text(response.incident_desc !== null ? response.incident_desc : 'none');

            $('#actionTakenLabel').text(response.action_taken);

        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                // Show SweetAlert error message with the error response from the server
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Record not found. Please make sure it exists.'
                });
            } else {
              var errorMessage = "An error occurred while fetching the record.";
    if (xhr.responseJSON && xhr.responseJSON.message) {
      errorMessage = xhr.responseJSON.message;
    }
                // Show a more informative error message for other types of errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        }
    });
});

</script>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
    <!-- Content -->
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Update Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form action="/mdrrmo/update-assistance" method="post">
        <div class="modal-body">
          @csrf
          <input type="hidden" id="id" name="id">
         
          <div class="form-group">
                <label for="incident_desc">Incident Description:</label>
                <textarea name="incidentDesc" id="incidentDesc" class="form-control"></textarea>
                @error('incidentDesc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="incident">Select an severity:</label><span class="text-danger">*</span>
                <select id="severity" name="severity" class="form-control">
                  <option value="" selected disabled>Select an severity</option>
                  <?php foreach ($severities as $severity): ?>
                    <option value="<?= $severity['id'] ?>"><?= $severity['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="locationName" class="form-control">
                @error('location')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="incident_desc">Action Taken:</label>
                <textarea name="actionTaken" id="actionTaken" class="form-control"></textarea>
                @error('actionTaken')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
            <label for="date_needed">Date Needed:</label>
            <input type="date" name="dateNeeded" id="dateNeeded" class="form-control" min="{{ date('Y-m-d') }}">
            @error('dateNeeded')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
              
              <div class="form-group">
                <label for="date_needed">Date Happened:</label>
                <input type="date" name="dateHappened" id="dateHappened" class="form-control">
                @error('dateHappened')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

          
            
        </div>

        <div class="modal-footer d-flex justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="updateRecord" class="btn btn-primary">
            Save Changes
          </button>
        </div>
      </form>
    </div>
    <!--/.Content-->
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
        order: [(0, "desc")]
    } );
} );
  </script>
  <script>
  function validateForm() {
    // Get the selected values
    var ownerValue = document.getElementById('owner').value;
    var incidentValue = document.getElementById('incident').value;

    // Check if any of the values is empty
    if (ownerValue === '' || incidentValue === '') {
      // Display an alert or perform any other action to notify the user
      alert('Please select both a municipality and an incident.');

      // Return false to prevent the form from being submitted
      return false;
    }

    // If the values are not empty, allow the form submission
    return true;
  }

          // Get the current date and time
   

</script>
