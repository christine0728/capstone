<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Memo
    </title>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">




        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

        <!-- Remove duplicate Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- Remove duplicate Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- Remove duplicate DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Memo</h4>
                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Send Memo</button> <p>
                  <form action="/pdrrmo/filter-memos" method="GET" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date:</label>
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <div class="form-group">
                          <label for="end_date">End Date:</label>
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <button type="submit" class="btn btn-primary">Apply Filter</button>
                      <a href="/pdrrmo/memo" class="btn btn-secondary">All</a>
                  </form>

                  <p class="card-description">
                    List of Memo
                  </p>
                  <div class="table-responsive">
                  <table class="table" id="table-data">
    <thead>
        <tr>
<<<<<<< Updated upstream
            <th>ID</th>
=======
            <th>Id</th>
>>>>>>> Stashed changes
            <th>Subject</th>
            <th>Memo</th>
            <th>Date Created</th>
            <th>Recipient(s)</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($memos as $memo)
            <tr>
<<<<<<< Updated upstream
                <td>{{ $memo->id }}</td>
=======
            <td>{{ $memo->id }}</td>
>>>>>>> Stashed changes
                <td>{{ $memo->subject }}</td>
                <td>
                    @if ($memo->attachments)
                        <a href="/pdrrmo/viewmemo/{{ $memo->attachments }}" target="_blank">{{ $memo->attachments }}</a>
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ date('F d, Y g:ia', strtotime($memo->created_at)) }}</td>
                <td>
                    @if ($memo->memoMunicipalities->isNotEmpty())
                        <button class="btn btn-primary toggleRecipients" data-memo-id="{{ $memo->id }}" style="font-size:13px;">Recipients</button>
                        <ul class="recipientsList" id="recipientsList_{{ $memo->id }}" style="display:none;">
                            @foreach ($memo->memoMunicipalities as $memoMunicipality)
                                <li>
                                    {{ $memoMunicipality->municipality->name }}
                                    @if ($memoMunicipality->read_at)
                                        <span class="text-success" style="font-size:9px;">Acknowledge</span>
                                    @else
                                        <span class="text-danger"  style="font-size:9px;">Not acknowledge</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No recipients
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td >No memos found.</td>
                <td >No memos found.</td>
                <td >No memos found.</td>
                <td >No memos found.</td>
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


    
<div class="modal fade right" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!-- Content -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Memo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/pdrrmo/insert-memo" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          @csrf
         
            <div class="form-group">
              <label for="subject" class="req-label">Memo Subject</label><span class="text-danger">*</span>
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject" autocomplete="off" value="{{ old('subject') }}" required>
              @error('subject')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="notes" class="req-label">Add Notes</label>
              <textarea class="form-control" style="width: 100%" name="notes" id="notes" placeholder="Add notes" autocomplete="off">{{ old('notes') }}</textarea>
              @error('notes')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div> <br>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="send_to_all" value="1" id="send-to-all" > Send to All Municipalities
                </label>
            </div>

            <div id="recipients-container" style="display: none;">
                <div class="form-group">
                    <label for="recipients">Select Recipients:</label>
                    <select name="recipients[]" multiple class="form-control" id="recipients">
                        @foreach ($recepient as $municipality)
                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endforeach
                    </select>
                    <div id="recipients-error" class="text-danger" style="display: none;">Please select recipients.</div>
                </div>
            </div>
            
     
            <div class="form-group">
            <label class="req-label">Attach Memo</label><span class="text-danger">*</span>
            <br>
            <div class="custom-file">
                 <input type="file" class="custom-file-input" id="attachments" name="attachments" accept=".pdf" required onchange="displayFileName()">

                <label class="custom-file-label" for="attachments" id="file-name-display">Choose file</label>
            </div>
  
    
          <div class="modal-footer" style="justify-content: flex-end;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
     
    </div>

  </div>
</div>


<!-- modaledit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-danger text-white">
                <h3 class="modal-title">Update Memo</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <form action="/pdrrmo/update-memo" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="req-label" for="subjects">Subject:</label>
                        <input type="hidden" name="memoId" id="memoId">
                        <input type="text" name="subjects" id="subjects" class="form-control" placeholder="Enter subject" value="{{ old('subject') }}" required>
                        @error('subject')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="req-label" for="note">Add Notes:</label>
                        <input type="text" name="note" id="note" class="form-control" placeholder="Add notes" value="{{ old('note') }}">
                        @error('note')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="req-label" for="attachments">Attach Memo:</label>
                        <input type="file" name="attachments" id="attachments" class="form-control" accept=".pdf, .doc, .docx">
                        @error('attachments')
                        <div id="fileSizeError" style="color: red;"></div>
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="updateRecord" class="btn btn-primary">Update Memo</button>
                </div>
            </form>
        </div>
    </div>
</div>





</body>
</html>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Successfully inserted!',
        text: '{{ session('success') }}'
    });
</script>
@endif
<!-- jQuery -->
<script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>

<!-- Popper.js -->
<script src="{{ asset('js/popper.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#content').toggleClass('active');
        });

        $('.more-button, .body-overlay').on('click', function () {
            $('#sidebar, .body-overlay').toggleClass('show-nav');
        });
    });
</script>


    <script>
       function displayFileName() {
        var input = document.getElementById('attachments');
        var display = document.getElementById('file-name-display');
        
        // Check if a file is selected
        if (input.files.length > 0) {
            // Get the file size in megabytes
            var fileSizeInMB = input.files[0].size / (1024 * 1024);

            // Check if the file size exceeds 5 MB
            if (fileSizeInMB > 5) {
                // Display an alert
                alert('File size should not exceed 5 MB.');
                // Clear the file input
                input.value = "";
                // Reset the file name display
                display.innerHTML = 'Choose file';
                return;
            }

            // Display the selected file name
            display.innerHTML = input.files[0].name;
        } else {
            // If no file is selected, reset the file name display
            display.innerHTML = 'Choose file';
        }
    }

    function validateForm() {
        var input = document.getElementById('attachments');

        // Check if a file is selected
        if (input.files.length > 0) {
            // Get the file size in megabytes
            var fileSizeInMB = input.files[0].size / (1024 * 1024);

            // Check if the file size exceeds 5 MB
            if (fileSizeInMB > 5) {
                // Display an alert
                alert('File size should not exceed 5 MB.');
                return false; // Prevent form submission
            }
        }

        // Your other form validation logic here

        return true; // Allow form submission
    }
  $(document).on('click', '.btn-edit', function() {
    // Get the data ID attribute from the clicked Edit button
    var id = $(this).data('id');

    // Perform AJAX request to fetch the record data based on the ID
    $.ajax({
    type: 'GET',
     url: '/pdrrmo/get-memo/' + id, // Replace '/get-record/' with the correct URL from your routes file
    dataType: 'json',
    success: function(response) {
        //Update the modal fields with the fetched data
        $('#memoId').val(response.id);
        $('#subjects').val(response.subject);
        $('#note').val(response.notes);
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



  
<script>
function checkFileSize(input) {
    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB (adjust as needed)
    const fileSize = input.files[0].size;

    if (fileSize > maxSizeInBytes) {
        document.getElementById('fileSizeError').textContent = 'File size exceeds the allowed limit (5MB).';
        input.value = ''; // Clear the input
    } else {
        document.getElementById('fileSizeError').textContent = '';
    }
}
 $(document).ready(function () {
        // Toggle the visibility of the recipients list when the button is clicked
        $('.toggleRecipients').on('click', function () {
            var memoId = $(this).data('memo-id');
            $('#recipientsList_' + memoId).toggle();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Toggle the display of the recipients container based on the checkbox value
        const sendToAllCheckbox = document.querySelector('[name="send_to_all"]');
        const recipientsContainer = document.getElementById('recipients-container');

        sendToAllCheckbox.addEventListener('change', function () {
            recipientsContainer.style.display = sendToAllCheckbox.checked ? 'none' : 'block';
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
  
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    
    <!-- Include Buttons Print library -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  
    <script>
    $(document).ready(function() {
<<<<<<< Updated upstream
    $('#table-data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        order: [[0, "desc"]]
    } );
} );
  </script>
=======
        $('#table-data').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [[0, 'desc']] // Assuming you want to sort the first column in descending order
        });
    });
</script>
<!-- Add this script to your HTML file -->
<script>
        function validateForm() {
            var sendToAllCheckbox = document.getElementById("send-to-all");
            var recipientsSelect = document.getElementById("recipients");
            var recipientsError = document.getElementById("recipients-error");

            if (!sendToAllCheckbox.checked && recipientsSelect.value.length === 0) {
                recipientsError.style.display = "block";
                alert("Please select recipients or check 'Send to All Municipalities'");
                return false; // Prevent form submission
            } else {
                recipientsError.style.display = "none";
                return true; // Allow form submission
            }
        }
    </script>
>>>>>>> Stashed changes
