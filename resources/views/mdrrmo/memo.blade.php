<!doctype html>
<html lang="en">

    <!-- Required meta tags -->
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resquire</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
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
                  <h3>Memos</h3><br>
                  <form action="/mdrrmo/filter-memos" method="GET" class="form-inline">
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
                      <a href="/mdrrmo/memo" class="btn btn-secondary">All</a>
                  </form>
                  <p class="card-description">
                    List of Memo 
                  </p>
                  <div class="table-responsive">
                    <table class="table" id="table-data">
                    <thead>
                   
                  <th>Subject</th>
                  <th>Memo</th>
                  <th style="width: 20%">Date created</th>
                  <th style="width: 30%">Acknowledge date <bR> 
                   <a href="#" onclick="Markall()" class="btn-" style="font-size: 12px;">Mark all as acknowledeged</a>
                </th>
                  <th>Details</th>
            
                </tr>
            </thead>
              <tbody>
                 @forelse ($memos as $memo)
                 <tr style="{{ $notificationId == $memo->memo->id ? 'background-color: #8fd3f3;' : '' }}">
          
                <td>{{ $memo->memo->subject}}</td>
                  <td> 
           
                  @if ($memo->memo->attachments)     
                  <a href="/mdrrmo/memo-prev/{{ $memo->memo->attachments }}" target="_blank">{{ $memo->memo->attachments }}</a>
                  @else
                      N/A
                  @endif
                  </td>
                  <td>{{ date('F d, Y g:ia', strtotime($memo->created_at)) }}</td>
                  <td>
                  @if (empty($memo->read_at))
                      <a href="/mdrrmo/readmark/{{ $memo->id }}">Mark as acknowledeged</a>
                  @else
                      {{ date('F d, Y g:ia', strtotime($memo->read_at)) }}
                  @endif
                                      
                  </td>
                      <td> 
                        <center>
                  <a href="#" class="btn-edit" data-toggle="modal" data-id="{{ $memo->memo_id }}" data-target="#modalEdit" > <center><i class="far fa-eye text-primary"></i> </center></a>
                  </center>
                </td>
                  
                </tr>
                @empty
                <tr>
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
            <br><br><br>
       @include('/mdrrmo/footer')
          
          </div>
          <!-- Include jQuery (you can change the version if needed) -->
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>

<!-- Include Popper.js -->
<script src="{{ asset('js/popper.min.js') }}"></script>

<!-- Include Bootstrap JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

        

        </div>
    </div>
</body>
</html>
<!-- modaledit -->
<div class="modal fade right" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Memo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="req-label">Subject</label>
                    <input type="hidden" name="memoId" id="memoId">
                    <h5 id="subjects"></h5>
                </div>
                <div class="form-group">
                    <label class="req-label">Notes</label>
                    <h5 id="note"></h5>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
@if(session('read'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Mark As Read',
        text: '{{ session('success') }}'
    });
</script>
@endif

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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<script>
   function MarkRead(id) {
    console.log(id);
    // Show SweetAlert confirmation
    Swal.fire({
      title: 'Mark as read',
  text: "Are you sure you want to mark this as read? You won't be able to revert this action.",
  icon: 'info', // You can change this to any of the available icons: 'success', 'error', 'warning', 'info'
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, mark as read!'
    }).then((result) => {
 
      if (result.isConfirmed) {
    
        $.ajax({
          type: 'get',
           url: '/mdrrmo/mark-read/'+id, 
        
    
          success: function (response) {
            // Display success message
            Swal.fire(
              'Mark as Read!',
              'The memo has been marked as read.',
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
              'Sorry, we couldn\'t mark the memo as read. Please try again later or contact support for assistance.',
              'error'
            );
          }
        });
      }
    });
  }

  
  function Markall() {
  // Show SweetAlert confirmation
  Swal.fire({
    title: 'Mark read!',
    text: "You won't be able to revert this!",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes!'
  }).then((result) => {

    if (result.isConfirmed) {

      $.ajax({
        type: 'GET',
        url: '/mdrrmo/markall',
        data: {
          _token: '{{ csrf_token() }}',
        },
        success: function (response) {
          // Display success message
          Swal.fire(
            'Mark all as read!',
          
            'success'
          ).then(function () {
            // Reload the page after marking all as read
            location.reload();
          });
        },
        error: function (error) {
          // Display error message
          Swal.fire(
            'Error!',
            'An error occurred while marking all memos as read.',
            'error'
          );
        }
      });
    }
  });
}


  $(document).on('click', '.btn-edit', function () {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform an AJAX request to fetch the record data based on the ID
    $.ajax({
        type: 'GET',
        url: '/mdrrmo/get-memo/' + id, // Replace '/get-record/' with the correct URL from your routes file
        dataType: 'json',
        success: function (response) {
            // Update the modal fields with the fetched data
            $('#memoId').text(response.id);
            $('#subjects').text(response.subject);
            $('#note').text(response.notes); 
        },
        error: function (xhr, status, error) {
            // Check if the response status code is 404 (Not Found)
            if (xhr.status === 404) {
                // Show SweetAlert error message with the error response from the server
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'The requested record was not found.'
                });
            } else {
                // Show a generic error message for other types of errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while fetching the record.'
                });
            }
        }
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