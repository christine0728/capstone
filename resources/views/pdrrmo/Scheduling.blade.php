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
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <!-- Include Bootstrap CSS (you can change the version if needed) -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    
    
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
  
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
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

@include('/pdrrmo/nav')

        <!-- Page Content  -->
        <div id="content">
 @include('/pdrrmo/header')
   
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
                events: SITEURL + "/pdrrmo/fullcalender",
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

                    for (var i = 0; i < eventsData.length; i++) {
    if (eventsData[i].id === event.id) {
        var userName = eventsData[i].user_name; // Replace 'user_name' with the actual field in your event data
            var title = event.title;
            var combinedTitle = userName + ': ' + title;

            element.find('.fc-title').html(combinedTitle);
        if (eventsData[i].userid === currentUserId) {
            element.css('background', 'linear-gradient(to bottom, #e74a3b, #c0392b)');
            element.css('border-color', '#c0392b');
            element.css('color', 'white');
            element.css('box-shadow', '0 2px 4px rgba(231, 76, 60, 0.2)');
            element.css('height','20px');
            element.css('font-size','9px');
        } else {
            element.css('background', 'linear-gradient(to bottom, #3498db, #2980b9)');
            element.css('border-color', '#2980b9');
            element.css('color', 'white');
            element.css('box-shadow', '0 2px 4px rgba(52, 152, 219, 0.2)');
            element.css('height','20px');
            element.css('font-size','9px');
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
                    $('#date-selected').text(selectedStartDate);
                    var selectedStart = new Date(start);
                    var selectedEnd = new Date(end);
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var formattedStartDate = selectedStart.toLocaleDateString('en-US', options);
                    var formattedEnd = selectedEnd.toLocaleDateString('en-US', options);

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
                                    url: SITEURL + '/pdrrmo/fullcalenderAjax',
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
                        url: SITEURL + '/pdrrmo/details/' + eventId,
                        type: 'GET',
                        success: function (response) {
                            console.log(response.event.userid);
                            var participantsJson;
                            console.log(response.event.participants);
// Check if response.event.participants is not null


// Assuming response.event.participants is a JSON string
var participantsJson = response.event.participants;

// Check if participantsJson is not null
if (participantsJson !== null) {
    // Parse JSON and create an array to store formatted entries
    participantsJson = JSON.parse(participantsJson);
    var formattedEntries = [];

    // Iterate over all keys and values in participantsJson
    for (var key in participantsJson) {
        if (participantsJson.hasOwnProperty(key)) {
            var value = participantsJson[key];

            // Format the entry and add it to the array with a newline
            var formattedEntry = key + ': ' + value;
            formattedEntries.push(formattedEntry);
        }
    }

    // Update HTML with formatted entries
    $('#attendee').html(formattedEntries.join('<br>'));
} else {
    // If participantsJson is null, display a message
    $('#attendee').html('Attendance not yet submitted');
}




                            $('#deleteEvent').data('eventId', response.event.id);
                            $('#eventId').val(response.event.id);
                            $('#event-title').val(response.event.title);
                            $('#event-Description').val(response.event.description);
                            $('#involveds').val(response.event.involved);
                            $('#event-Start').val(response.event.start_time);
                            $('#event-End').val(response.event.end_time);
                            $('#locations').val(response.event.location);
                            $('#municipality-name').text(response.event.municipality_name);

                            if (response.currentUserId === response.event.userid) {
                                $('#updateEvent').show();
                                $('#cancelButton').show();
                                $('#deleteEvent').show();
                                $('#updateLabel').show();
                                $('#viewLabel').hide();
                            } else {
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
                        url: SITEURL + '/pdrrmo/fullcalenderAjax',
                        data: {
                            id: eventId,
                            type: 'delete'
                        },
                        success: function (response) {
                            setTimeout(function () {
                                displayMessageDel("Event Deleted Successfully");
                                window.location.href = '/pdrrmo/schedule';
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
                 var recipient = $('#m_id').val();
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
                        url: SITEURL + "/pdrrmo/fullcalenderAjax",
                        data: {
                            recipient:recipient,
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
                                window.location.href = '/pdrrmo/schedule';
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

    // Reload the entire pagelocation.reload();
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


            function displayMessage(message) {
                toastr.success(message, 'Event');
            }
            function displayMessageDel(message) {
            toastr.error(message, 'Event');
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
                <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        Event Date:<span id="date-selected"></span><br>
                       
                        <label for="eventTitle">Event Title:</label>
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                    </div>

                    <div class="form-group">
                        <label for="eventDescription">Event Description:</label>
                        <textarea class="form-control" id="eventDescription" name="eventDescription" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="municipality" class="req-label">Recipient</label>
                        <select class="form-control select-mun" id="municipality" name="municipality" required>
                            <option value="" disabled selected>Choose a municipality</option>
                            <option value="all">All</option>
                            @foreach ($recepient as $recepients)
                                <option value="{{ $recepients->id }}">{{ $recepients->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="req-label">Selected Recipient</label>
                        <div class="recipient-input">
                            <input type="text" class="form-control" id="municipality_name" name="municipality_name"
                                placeholder="Selected recipients" readonly>
                                <br>
                            <button name="clear" id="clear-button" type="button" class="btn btn-secondary">Clear</button>
                        </div>
                    </div>

                    <input type="hidden" name="m_id" id="m_id">
                    <div class="form-group">
                        <label for="location">Venue:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="eventStart">Start Time:</label>
                        <input type="time" class="form-control" id="eventStart" name="eventStart" required>
                    </div>
                  
                    <div class="form-group">
                        <label for="eventEnd">End Time:</label>
                        <input type="time" class="form-control" id="eventEnd" name="eventEnd" required>
                    </div>

                
                </form>
            </div>
            <div class="modal-footer">
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
                <h5 class="modal-title" id="updateLabel" style="color:white">Update Event</h5>
                <h5 class="modal-title" id="viewLabel" style="color:white">Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
               
                <form id="eventForm" method="post" action="/pdrrmo/update-event">
                    @csrf
                    <h5>Submitted attendance:</h5>
                    <span id="attendee" name="attendee"></span>
                    <div class="form-group">
                        <label for="eventTitle">Event Title:</label>
                        <input type="hidden" class="form-control" id="eventId" name="eventId" required>
                        <textarea class="form-control" id="event-title" name="event-title" REQUIRED></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Event Description:</label>
                        <textarea class="form-control" id="event-Description" name="event-Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Venue:</label>
                        <input type="type" class="form-control" id="locations" name="locations" required>
                    </div>
               
                    <div class="form-group">
                        <label for="eventDescription">Start Time:</label>
                        <input type="time" class="form-control" id="event-Start" name="event-Start" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">End Time:</label>
                        <input type="time" class="form-control" id="event-End" name="event-End" required>
                    </div>
               
              
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="updateEvent">Update</button>
                <button type="button" class="btn btn-primary" id="deleteEvent">Delete</button>
            </div>
            </form>
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
<script>
    // Get the select element
    var select = document.getElementById('municipality');
    
    // Get the input element for displaying selected names
    var inputMunicipalityName = document.getElementById('municipality_name');
    
    // Get the input element for storing selected IDs
    var inputMunicipalityId = document.getElementById('m_id');
    
    // Get the "Clear" button element
    var clearButton = document.getElementById('clear-button');
    
    // Store the selected options
    var selectedOptions = [];
    
    // Function to reset the form
    function resetForm() {
        select.disabled = false;
        inputMunicipalityName.value = '';
        inputMunicipalityId.value = '';
        selectedOptions = [];
    }
    
    // Add an event listener to the select element
    select.addEventListener('change', function () {
        if (select.value === 'all') {
            // Disable the select element
            select.disabled = true;
            
            // Clear the input field and set its value to "All"
            inputMunicipalityName.value = 'All';
            
            // Clear the selectedOptions array and add "all" to it
            selectedOptions = ['all'];
        } else {
            var newlySelected = Array.from(select.selectedOptions).filter(option => !selectedOptions.includes(option.value));
            selectedOptions = selectedOptions.concat(newlySelected.map(option => option.value));
            
            // Update the input field with selected names
            inputMunicipalityName.value = selectedOptions.map(optionValue => {
                return Array.from(select.options).find(option => option.value === optionValue).text;
            }).join(', ');
        }
        console.log("Selected Options:", selectedOptions);
        
        // Update the hidden input field with selected IDs
        inputMunicipalityId.value = selectedOptions.join(',');
    });
    
    // Add an event listener to the "Clear" button
    clearButton.addEventListener('click', function () {
        resetForm();
    });
    </script>