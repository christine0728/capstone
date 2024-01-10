<!DOCTYPE html>
<html>
<head>
<title>Resquire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

      <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    
</head>
<style>
     .fc-head-container{
        background: #04BADE;
        color: white;
    }
    .fc-unthemed td.fc-today {
 
    background: #90e0ef;
}
    .fc-bg {
    bottom: 0;
    background: white;
}
    .fc th, .fc td {
d;
    border-style: solid;
    border-width: 3px;
    padding: 0;
    vertical-align: top;
}

</style>
<body>


<div class="body-overlay"></div>

@include('/mdrrmo/nav')

        <!-- Page Content  -->
        <div id="content">
 @include('/mdrrmo/header')
   
    <div class="cont">
    <div class="row">
    <div class="column1" style="text-align: center;">
    <br>Search:
        <input type="text" id="eventSearch" placeholder="Search" style="
            width: 30%;
            padding:10px
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        "><br><br>
        <div id='calendar' style="width: 80%; display: inline-block;"></div>
    </div>
    <div class="column2"></div>
</div>

            
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script>
    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        var selectedStartDate, selectedEndDate;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL + "/mdrrmo/fullcalender",
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
                var currentUserId = {{ $currentUserId }};
                var eventsData = @json($events);
                 console.log(eventsData);
                // Object to keep track of processed randomIds
                var processedRandomIds = {};

                for (var i = 0; i < eventsData.length; i++) {
                    var randomId = eventsData[i].randomId;

                    // Check if this randomId has been processed before
                    if (!processedRandomIds.hasOwnProperty(randomId)) {
                        processedRandomIds[randomId] = true;
                           console.log()
                        var userName = eventsData[i].user_name;
                        var title = event.title;
                        var combinedTitle = title;
                        var combinedTitle = title;

                        console.log(eventsData[i].userid);
                        console.log(currentUserId);
                        // Update the event's title
                        element.find('.fc-title').html(combinedTitle);
                         
                        // Customize the event's appearance based on conditions
                        if (eventsData[i].userid === currentUserId) {
                            element.css({
                                'background': 'linear-gradient(to bottom, #e74a3b, #c0392b)',
                                'border-color': '#c0392b',
                                'color': 'white',
                                'box-shadow': '0 2px 4px rgba(231, 76, 60, 0.2)',
                                'height': '25px',
                                'font-size': '9px'
                            });
                        } else {
                            element.css({
                                'background': 'linear-gradient(to bottom, #3498db, #2980b9)',
                                'border-color': '#2980b9',
                                'color': 'white',
                                'box-shadow': '0 2px 4px rgba(52, 152, 219, 0.2)',
                                'height': '25px',
                                'font-size': '9px'
                            });
                        }
                        break;
                    }
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                selectedStartDate = start;
                selectedEndDate = end;
                $('#eventModal').modal('show');
                var selectedStart = new Date(start);
               
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var formattedStartDate = selectedStart.toLocaleDateString('en-US', options);
                    $('#date-selected').text(formattedStartDate);
            },
            eventDrop: function (event, delta) {
                var start = event.start.format("Y-MM-DD");
                var end = event.end.format("Y-MM-DD");
                var currentUserId = {{ $currentUserId }};
                var eventsData = @json($events);

                for (var i = 0; i < eventsData.length; i++) {
                    if (eventsData[i].id === event.id) {
                        if (eventsData[i].userid === currentUserId) {
                            $.ajax({
                                url: SITEURL + '/mdrrmo/fullcalenderAjax',
                                data: {
                                    title: event.title,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'update'
                                },
                                type: "get",
                                success: function (response) {
                                    displayMessage("Event Updated Successfully");
                                }
                            });
                        } else {
                            displayMessage("You are not authorized to update this event.");
                            location.reload();
                            return;
                        }
                        break;
                    }
                }
            },
            eventClick: function (event) {
                var eventId = event.id;
                $.ajax({
                    url: SITEURL + '/mdrrmo/details/' + eventId,
                    type: 'GET',
                    success: function (response) {
                        $('#deleteEvent').data('eventId', response.event.id);
                        $('#eventId').val(response.event.id);
                        $('#event-title').val(response.event.title);
                        var participants = JSON.parse(response.event.participants);
                        var username = response.username;

                        if (participants && typeof participants === "object" && participants.hasOwnProperty(username)) {
                            // 'username' exists in 'participants', so you can access its value
                            var value = participants[username];
                            $('#event-attendance').val(value);
                            console.log("Value for " + username + " is: " + value);
                        } else {
                            // 'username' doesn't exist in 'participants'
                            console.log(username + " not found in participants");
                        }
                        console.log(response.event.type);
                        if(response.event.type == 'mdrrmo'){
                            $('#event-attendance').hide();
                        }else{
                            $('#event-attendance').show();

                        }
                        $('#eventId').val(response.event.id);
                        $('#event-Title').val(response.event.title);
                        $('#event-Description').val(response.event.description);
                        $('#involveds').val(response.event.involved);
                        $('#event-Start').val(response.event.start_time);
                        $('#event-End').val(response.event.end_time);
                        $('#locations').val(response.event.location);
                        $('#eventdescription').text(response.event.description);
                        $('#eventtitle').text(response.event.title);
                        $('#eventstart').text(response.event.start_time);
                        $('#eventend').text(response.event.end_time);
                        $('#venue').text(response.event.location);

                        $('#municipality-name').text(response.event.municipality_name);

                        if (response.currentUserId === response.event.userid) {
                            $('#updateEvent').show();
                            $('#attendanceEvent').hide();
                            $('#updateEvent').show();
                            $('#cancelButton').show();
                            $('#deleteEvent').show();
                            $('#updateLabel').show();
                            $('#viewLabel').hide();
                            $('#eventdescription').hide();
                            $('#eventtitle').hide();
                            $('#eventstart').hide();
                            $('#eventend').hide();
                            $('#venue').hide();
                            $('#event-Title').show();
                            $('#event-Description').show();
                            $('#locations').show();
                            $('#event-Start').show();
                            $('#event-End').show();
                        } else {
                            $('#eventtitle').show();
                            $('#eventstart').show();
                            $('#eventend').show();
                            $('#venue').show();
                            $('#attendanceEvent').show();
                            $('#event-Title').hide();
                            $('#event-Description').hide();
                            $('#locations').hide();
                            $('#event-Start').hide();
                            $('#event-End').hide();
                            $('#updateEvent').hide();
                            $('#cancelButton').hide();
                            $('#updateLabel').hide();
                            $('#viewLabel').show();
                            $('#deleteEvent').hide();
                        }

                        $('#updateModal').modal('show');
                    }
                });
            }
        });

        $('#deleteEvent').on('click', function () {
            var eventId = $(this).data('eventId');
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "get",
                    url: SITEURL + '/mdrrmo/fullcalenderAjax',
                    data: {
                        id: eventId,
                        type: 'delete'
                    },
                    success: function (response) {
                        displayMessageDel("Event Deleted Successfully");
                        setTimeout(function () {
                                window.location.href = '/mdrrmo/Schedule';
                            }, 1000);
                        var calendar = $('#calendar').fullCalendar('getCalendar');
                        calendar.fullCalendar('removeEvents', event.id);
                        calendar.fullCalendar('refetchEvents');
                        $('#updateModal').modal('hide');
                      
                      
                    }
                });
            }
        });

        $('#saveEvent').on('click', function () {
            var title = $('#eventTitle').val();
            var description = $('#eventDescription').val();
            var type = $('#event_type').val();
            var timeStart = $('#eventStart').val();
            var timeEnd = $('#eventEnd').val();
            var location = $('#location').val();
            var involved = $('#involved').val();
            if (title && selectedStartDate && selectedEndDate) {
                var start = selectedStartDate.format("YYYY-MM-DD");
                var end = selectedEndDate.format("YYYY-MM-DD");

                $.ajax({
                    url: SITEURL + "/mdrrmo/fullcalenderAjax",
                    data: {
                        title: title,
                        start: start,
                        involved: involved,
                        description: description,
                        timeStart: timeStart,
                        timeEnd: timeEnd,
                        location: location,
                        end: end,
                        type: 'add'
                    },
                    type: "GET",
                    success: function (data) {
                        displayMessage("Event Created Successfully");
                        setTimeout(function () {
                                window.location.href = '/mdrrmo/Schedule';
                            }, 3000);
                        var calendar = $('#calendar').fullCalendar('getCalendar');
                        calendar.fullCalendar('refetchEvents');

                        // Render the new event
                        var newEvent = {
                            title: title,
                            start: start,
                            description: description,
                            involved: involved,
                            timeStart: timeStart,
                            timeEnd: timeEnd,
                            location: location,
                            end: end,
                            allDay: allDay
                        };
                        calendar.fullCalendar('renderEvent', newEvent, true);
                        calendar.fullCalendar('unselect');

                        // Reload the entire page
                        location.reload();
                    }
                });
                $('#eventTitle').val('');
                $('#eventDescription').val('');
                $('#eventModal').modal('hide');
            }
        });

        $('#eventSearch').on('input', function () {
            var searchQuery = $(this).val().trim();

            if (searchQuery === '') {
                calendar.fullCalendar('refetchEvents');
            } else {
                calendar.fullCalendar('removeEvents', function (event) {
                    return event.title.toLowerCase().indexOf(searchQuery.toLowerCase()) === -1;
                });
            }
        });
        function displayMessageDel(message) {
            toastr.error(message, 'Event');
        }
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    });
</script>

    
</main>

</body>
</html>

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

<!-- Hidden Modal for Event Input -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="eventModalLabel">Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                Event Date:<span id="date-selected"></span><br>
                    <div class="form-group">
                        <label for="eventTitle">Event Title:</label>
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter Title" required>
                    </div>

                    <div class="form-group">
                        <label for="eventDescription">Event Description:</label>
                        <textarea class="form-control" id="eventDescription" name="eventDescription" placeholder="Enter description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="eventStart">Start Time:</label>
                        <input type="time" class="form-control" id="eventStart" name="eventStart" required>
                    </div>

                    <div class="form-group">
                        <label for="eventEnd">End Time:</label>
                        <input type="time" class="form-control" id="eventEnd" name="eventEnd" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Venue:</label>
                        <input type="text" class="form-control" id="location" name="location"  placeholder="Enter venue" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="justify-content: flex-end;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="updateLabel" style="color:white">Update </h5><br>
                <h5 class="modal-title" id="viewLabel" style="color:white">Schedule Event</h5> <br>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
              
                <form method="post" action="/mdrrmo/event-update">
                    @csrf
                    <input type="hidden" class="form-control" id="eventId" name="eventId" >
                   
        
                    
                   
                    <div class="form-group">
                        <center>
                    <span id="municipality-name" ></span> </center>
                        <textarea class="form-control" id="event-attendance" name="event-attendance" placeholder="Enter the attendance"></textarea>
                        <label id="eventattendance" name="event-attendance"  ></label>
                  
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Event title:</label>
                        <textarea class="form-control" id="event-Title" name="event-Title" ></textarea>
                        <span id="eventtitle" name="eventtitle" ></span>
               
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Event Description:</label>
                        <textarea class="form-control" id="event-Description" name="event-Description" ></textarea>
                        <span id="eventdescription" name="eventDescription" ></span>
               
                    </div>
    
                    <div class="form-group">
                        <label for="eventDescription">Start Time:</label>
                        <input type="time" class="form-control" id="event-Start" name="event-Start" >
                        <span id="eventstart" name="eventstart" ></span>
                
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">End Time:</label>
                        <input type="time" class="form-control" id="event-End" name="event-End" >
                        <span id="eventend" name="eventend"></label>
                   
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Venue:</label>
                        <input type="type" class="form-control" id="locations" name="locations" >
                        <span id="venue" name="location"></span>
                
                    </div>
                
            </div>
            <div class="modal-footer d-flex justify-content-end">
          
                <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="updateEvent">Update</button>
                <button type="button" class="btn btn-primary" id="deleteEvent">Delete</button>
                <button type="submit" class="btn btn-primary" id="attendanceEvent">Submit Attendance</button>
                </form> 
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