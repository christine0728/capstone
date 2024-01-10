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

       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <!-- Include Bootstrap CSS (you can change the version if needed) -->
       <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
 
 <!-- Include your custom CSS file (if you have one) -->
 <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

  
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
                  <h4 class="card-title">event</h4>
                  <form action="/mdrrmo/filter-event" method="GET" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date:</label>&nbsp;
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <div class="form-group">
                          <label for="end_date">End Date:</label>&nbsp;
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>&nbsp;

                      <button type="submit" class="btn btn-primary">Apply Filter</button>&nbsp;
                      <a href="/mdrrmo/Schedule-table" class="btn btn-secondary">All</a>
                  </form>
                  <p class="card-description">
                    List of events
                  </p>
                  <div class="table-responsive">
                  <table class="table"  id="table-data"  style="width:100%">
              <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Description</th>
                  <th>Location</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($events as $event)
                <tr>
                  <td>{{  $event->title }}</td>
                  <td>{{  $event->description}}</td>
                  <td>{{  $event->location}}</td>
                  <td>{{ $event->start}}</td>
                  <td>{{ $event->end}}</td>
                  <td>{{ $event->start_time}}</td>
                  <td>{{ $event->end_time}}</td>  
                  <td>{{ date('F d, Y g:ia', strtotime($event->created_at)) }}</td>  
                  <td>    
                  <div class="btn-group" role="group">
                  <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $event->id }}" data-target="#modalDetails">
                                      <button type="button" class="btn btn-primary btn-xs btn-sm">
                                          <i style="color: white; font-size: 12px;" class="fa fa-eye"></i>
                                      </button>
                                  </a>&nbsp;
                    <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $event->id }}" data-target="#modalEdit">
                                      <button type="button" class="btn btn-success btn-xs btn-sm">
                                          <i style="color: white; font-size: 12px;" class="fa fa-edit"></i>
                                      </button>
                                  </a>&nbsp;

<!-- 
                                  <a href="#" onclick="confirmDelete('{{$event->id }}')" class="btn btn-danger btn-xs btn-sm">
                                      <i style="color: white; font-size: 12px;" class="fas fa-trash-alt"></i>
                                  </a> -->
                </div>
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
<div class="modal fade right" id="modalRelatedContent" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 style="color:white ;">New Request </h4>
      

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
      <div class="row">
    <div style="margin: 20px;">
    
    </div>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modaledit-->
<div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header bg-primary" >
      <h4 class="modal-title text-white">Update Event</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
    

        <form id="eventForm" method="post" action="/mdrrmo/update-event">
          @csrf
          <div class="form-group" style="width: 100%">
            <label for="eventTitle">Event Title:</label>
            <input type="hidden" class="form-control" id="eventId" name="eventId" required>
            <input type="text" class="form-control" id="event-title" name="event-title" required>
          </div>
          <div class="form-group" style="width: 100%">
            <label for="eventDescription">Event Description:</label>
            <textarea class="form-control" id="event-Description" name="event-Description" required></textarea>
          </div>
          <div class="form-group" style="width: 100%">
    <label for="eventDescription">Start Time:</label>
    <input type="time" class="form-control" id="event-Start" name="event-Start" required>
</div>
<div class="form-group" style="width: 100%">
    <label for="eventDescription">End Time:</label>
    <input type="time" class="form-control" id="event-End" name="event-End" required>
</div>

          <div class="form-group" style="width: 100%">
            <label for="eventDescription">Venue:</label>
            <input type="text" class="form-control" id="locations" name="locations" required>
          </div>
          <div class="modal-footer d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="updateEvent">Update</button>
          </div>
        </form>
      </div>
    </div>
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
              <label for="owner" style="font-weight: bold;">Event:</label>
              <label id="event"></label>
            </div>

            <div class="form-group">
              <label for="incident" style="font-weight: bold;">Event details:</label>
              <label id="details"></label>
            </div>
            <label for="location" id="attend"style="font-weight: bold;">Attendee:</label>
            <div class="form-group">
           
              <label id="attendee"></label>
            </div>

            <div class="form-group">
              <label for="actionTaken" style="font-weight: bold;">Date start:</label>
              <label id="date-start"></label>
            </div>
            <div class="form-group">
              <label for="actionTaken" style="font-weight: bold;">Date end:</label>
              <label id="date-end"></label>
            </div>
            <div class="form-group">
              <label for ="dateNeeded" style="font-weight: bold;">Time start</label>
              <label id="time-start"></label>
            </div>

            <div class="form-group">
              <label for="incidentDesc" style="font-weight: bold;">Time end:</label>
              <label id="time-end"></label>
            </div>
            <div class="form-group">
              <label for="dateHappened" style="font-weight: bold;">location:</label>
              <label id="location"></label>
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
          url: '/mdrrmo/destroy-event/' + id, 
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
              'You cannot delete the event. It was already in use.',
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
     url: '/mdrrmo/get-sched/' + id, // Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
      var currentUserId = response.currentUserId;
      var recordUserId = response.record.userid;

if (currentUserId === recordUserId) {
  
  $("#attend").hide();
    // User IDs match, show the button
    $("#attendee").hide();
    $("#updateEvent").show();
} else {
  $("#attend").show();
    // User IDs do not match, hide the button
    $("#attendee").show();
    $("#updateEvent").hide();
}
        $('#details').text(response.record.description);
        // Assuming response.participants is a JSON string
        var participantsObj;
        if (response.record.participants) {
            participantsObj = JSON.parse(response.record.participants);
        } else {
            // If null, set a default value
            participantsObj = { "attendance": "Not yet submitted" };
        }
        var formattedParticipants = '';
        for (var key in participantsObj) {
            formattedParticipants += key + ': ' + participantsObj[key] + '<br>';
        }
        $('#attendee').html(formattedParticipants);

        var startDate = new Date(response.record.start);
        var endDate = new Date(response.record.end);
        // updateEvent
        console.log(response.record.userid)
        // Format dates to "Month day, Year" format
        var formattedStartDate = startDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
        var formattedEndDate = endDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

        // Set the formatted dates to the corresponding labels
        $('#date-start').text(formattedStartDate);
        $('#date-end').text(formattedEndDate);
        $('#time-start').text(response.record.start_time);
        $('#time-end').text(response.record.end_time);
        $('#location').text(response.record.location);
        $('#event').text(response.record.title);
        $('#eventId').val(response.record.id);
        $('#event-title').val(response.record.title);
        $('#event-Description').val(response.record.description);
        $('#event-Start').val(response.record.start_time);
        $('#event-End').val(response.record.end_time);
        $('#locations').val(response.record.location);
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