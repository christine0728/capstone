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
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            
      <!-- Include Bootstrap CSS (you can change the version if needed) -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        
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
              <div class="card" style="width: 105%">
                <div class="card-body">
                  <h3>Situational Report</h3><br>
                
                  <a class="btn btn-primary btn-xs" href="/pdrrmo/export">
                        export
                    </a>
                      <form action="/pdrrmo/filter-sitrep" method="GET" class="form-inline">
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
                      <a href="/pdrrmo/sitrep" class="btn btn-secondary">All</a>
                  </form><br>
                  <p class="card-description">
                    List of Situational Report
                  </p>
                  <div class="table-responsive">
                  <table class="table" id="table-data" style="width:100%">
                      <thead>
                        <tr>
                        <th style="width: 150px;">Id</th>
                        <th style="width: 150px;">Municipality</th>
                        <th style="width: 150px;">Subject</th>    
                        <th style="width: 150px;">created_at</th>
                        <th style="width: 150px;">Export</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse ($sitreps as $sitrep)
                      <tr style="{{ $notificationId == $sitrep->id ? 'background-color: #8fd3f3;' : '' }}">
                      <td>{{ $sitrep->id }}</td>
               <td>{{ $sitrep->municipality }}</td>
               <td>{{ $sitrep->subject_name }} {{$notificationId}}</td>
             
               <td>{{ date('F d, Y g:ia', strtotime($sitrep->created_at )) }}</td>
               <td>     
                <div class="btn-group" role="group">
                   
                 
                <a class="btn btn-primary btn-xs" href="{{ route('sitrep.detail', ['id' => $sitrep->id]) }}">
                <i class="fas fa-file-export" style="color: white; font-size: 15px;"></i>
                    </a>
              </div>                 
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
     <form action="/pdrrmo/submit-sitrep" method="post" >
     @csrf
<div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary bg-primary">
          <h4  class="heading">I.SITUATION SUMMARY</h4> <br>
            <button type="button" class="close" aria-label="Close"  onclick="closeModal('modal1')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
           <div class="modal-body">
           <h4 class="heading">A.General Weather Condition</h4>
           <div class="form-group">
            <label for="general_weather_conditions">General Weather Condition</label>
            <input type="text" class="form-control" id="general_weather_conditions" name="general_weather_conditions">
        </div>
        <div class="form-group">
            <label for="tcws">TCWS</label>
            <input type="text" class="form-control" id="tcws" name="tcws">
        </div>
        <div class="form-group">
            <label for="dam_situation">Dam Situation</label>
            <input type="text" class="form-control" id="dam_situation" name="dam_situation">
        </div>
      
           </div>
           <div class="modal-footer">
      <div class="button-container">
          <button type="button" class="modal-button btn btn-primary" onclick="nextModal(1, 2)">Next</button>
      </div>
      <div class="page-indicator">
          Page 1
      </div>
  </div>

      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary bg-primary">
            <h3 style="color:white" class="heading">page 2 .Modal 2</h3>
            <button type="button" class="close"  aria-label="Close"  onclick="closeModal('modal2')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
           <div class="form-group">
          <label for="related_incident">Related Incident</label>
          <input type="text" class="form-control" id="related_incident" name="related_incident">
        </div>
        <div class="form-group">
          <label for="affected_population">Affected Population</label>
          <input type="text" class="form-control" id="affected_population" name="affected_population">
        </div>
        <div class="form-group">
          <label for="casualties">Casualties</label>
          <input type="text" class="form-control" id="casualties" name="casualties">
        </div>
        <div class="form-group">
          <label for="status_of_lifelines">Status of Lifelines</label>
          <input type="text" class="form-control" id="status_of_lifelines" name="status_of_lifelines">
        </div>
              <div class="modal-footer">
                   <div class="button-container">
                   <button type="button" class="modal-button btn btn-secondary" data-current-modal="2" data-prev-modal="1">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(2, 3)">Next</button>
                  </div>
                        <div class="page-indicator">
                        Page 2
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary">
            <h3 class="heading">page 3Modal 3</h3>
            <button type="button" class="close"  aria-label="Close"  onclick="closeModal('modal3')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
           <label class="form-label">Related Incedent</label> <br>
              <div class="form-group">
                <label for="roads_and_bridges">Roads and Bridges</label>
                <input type="text" class="form-control" id="roads_and_bridges" name="roads_and_bridges">
              </div>

              <div class="form-group">
                <label for="power">Power</label>
                <input type="text" class="form-control" id="power" name="power">
              </div>

              <div class="form-group">
                <label for="water">Water</label>
                <input type="text" class="form-control" id="water" name="water">
              </div>

              <div class="form-group">
                <label for="communication_lines">Communication Lines</label>
                <input type="text" class="form-control" id="communication_lines" name="communication_lines">
            </div>
     
            <br>
              <div class="modal-footer">
                   <div class="button-container">
                   <button type="button"class="modal-button btn btn-secondary" data-current-modal="3" data-prev-modal="2">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(3, 4)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 3
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary">
            <h3 class="heading">Modal 4</h3>
            <button type="button" class="close"  aria-label="Close"  onclick="closeModal('modal4')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
           <div class="form-group">
              <label for="damaged_house">Damaged Houses</label>
              <input type="text" class="form-control" id="damaged_house" name="damaged_house">
            </div>

            <div class="form-group">
              <label for="cost_of_damages">Cost of Damages</label>
              <input type="text" class="form-control" id="cost_of_damages" name="cost_of_damages">
            </div>

            <div class="form-group">
              <label for="damage_to_agriculture">Damage to Agriculture</label>
              <input type="text" class="form-control" id="damage_to_agriculture" name="damage_to_agriculture">
            </div>

            <div class="form-group">
              <label for="damage_to_infrastructure">Damage to Infrastructure</label>
              <input type="text" class="form-control" id="damage_to_infrastructure" name="damage_to_infrastructure">
            </div>
            <br>
              <div class="modal-footer">
                   <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="4" data-prev-modal="3">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(4, 5)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 4
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary">
                    <h3 class="heading">Modal 5</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal5')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="class_suspension">Class Suspension</label>
                        <input type="text" class="form-control" id="class_suspension" name="class_suspension">
                    </div>

                    <div class="form-group">
                        <label for="work_suspension">Work Suspension</label>
                        <input type="text" class="form-control" id="work_suspension" name="work_suspension">
                    </div>

                    <div class="form-group">
                        <label for="state_of_calamity">State of Calamity</label>
                        <input type="text" class= "form-control" id="state_of_calamity" name="state_of_calamity">
                    </div>

                    <div class="form-group">
                        <label for="preemptive_evacuation">Pre-emptive Evacuation</label>
                        <input type="text" class="form-control" id="preemptive_evacuation" name="preemptive_evacuation">
                    </div>

                    <div class="form-group">
                        <label for="preemptive_evacuation_animals">Pre-emptive Evacuation Animals</label>
                        <input type="text" class="form-control" id="preemptive_evacuation_animals" name="preemptive_evacuation_animals">
                    </div>

                    <div class="form-group">
                        <label for="assistance_provided">Assistance Provided</label>
                        <input type="text" class="form-control" id="assistance_provided" name="assistance_provided">
                    </div>
                    <div class="form-group">
                        <label for="assistance_provided">Assistance Provided</label>
                        <input type="text" class="form-control" id="assistance_provided" name="assistance_provided">
                    </div>
                    <div class="form-group">
                        <label for="assistance_provided">Assistance Provided</label>
                        <input type="text" class="form-control" id="assistance_provided" name="assistance_provided">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="5" data-prev-modal="4">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(5, 6)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 5
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
  <div class="modal" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content" style="max-height: 80vh; overflow-y: auto;">
        <!--Header-->
        <div class="modal-header bg-primary">
          <h3 class="heading">Modal 6</h3>
          <button type="button" class="close" aria-label="Close" onclick="closeModal('modal6')">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body">
        <h4>iii. Disaster Preparedness</h4>
<div class="form-group">
  <label for="disaster_preparedness">Disaster Preparedness</label>
  <textarea class="form-control" id="disaster_preparedness" name="disaster_preparedness" rows="5"></textarea>
</div>

        </div>
        <div class="modal-footer">
          <div class="button-container">
            <button type="button" class="modal-button btn btn-secondary" data-current-modal="6" data-prev-modal="5">Previous</button>
            <button type="button" class="modal-button btn btn-primary" onclick="nextModal(6, 7)">Next</button>
          </div>
          <div class="page-indicator">
              Page 6
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary">
                    <h3 class="heading">Modal 7</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal7')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="disaster_response">Disaster Response</label>
                        <input type="text" class="form-control" id="disaster_response" name="disaster_response">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="food_and_non_food">Food and Non-food</label>
                        <input type="text" class="form-control" id="food_and_non_food" name="food_and_non_food">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pccm">PCCM</label>
                        <input type="text" class="form-control" id="pccm" name="pccm">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="health">Health</label>
                        <input type="text" class="form-control" id="health" name="health">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="search_rescue_retrieval">Search and Rescue Retrieval</label>
                        <input type="text" class="form-control" id="search_rescue_retrieval" name="search_rescue_retrieval">
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="7" data-prev-modal="6">Previous</button>
                        <button type="button"class="modal-button btn btn-primary" onclick="nextModal(7, 8)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 7
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="modal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header bg-primary">
          <h3 style="color:white" class="heading">Modal 8</h3>
          <button type="button" class="close" aria-label="Close" onclick="closeModal('modal')">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
          <div class="form-group">
            <label for="logistics">Logistics</label>
            <input type="text" class="form-control" id="logistics" name="logistics">
          </div>
          <br>
          <div class="form-group">
            <label for="emergency_telecommunications">Emergency Telecommunication</label>
            <input type="text" class="form-control" id="emergency_telecommunications" name="emergency_telecommunications">
          </div>
          <br>
          <div class="form-group">
            <label for="education">Education</label>
            <input type="text" class="form-control" id="education" name="education">
          </div>
          <br>
          <div class="form-group">
            <label for="damage_assessment_needs_analysis">Damage Assessment & Needs Analysis</label>
            <input type="text" class="form-control" id="damage_assessment_needs_analysis" name="damage_assessment_needs_analysis">
          </div>
          <br>
          <div class="form-group">
            <label for="law_order">Law & Order</label>
            <input type="text" class="form-control" id="law_order" name="law_order">
          </div>
        </div>
        <div class="modal-footer">
          <div class="button-container">
            <button type="button" class="modal-button btn btn-secondary" data-current-modal="8" data-prev-modal="7">Previous</button>
            <button type="submit" class="modal-button btn btn-primary" >Submit</button>
          </div>
          <div class="page-indicator">
              Page 8
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</form>

<script>
    function nextModal(currentModal, nextModal) {
        document.getElementById('modal' + currentModal).style.display = 'none';
        document.getElementById('modal' + nextModal).style.display = 'block';
    }

    function prevModal(currentModal, prevModal) {
        document.getElementById('modal' + currentModal).style.display = 'none';
        document.getElementById('modal' + prevModal).style.display = 'block';
    }

    // Add event listeners to all modal buttons
    document.querySelectorAll('[id^="openModal"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const currentModal = this.getAttribute('data-current-modal');
            const nextModal = this.getAttribute('data-next-modal');
            document.getElementById('modal' + currentModal).style.display = 'none';
            document.getElementById('modal' + nextModal).style.display = 'block';
        });
    });

    // Add event listeners to all "Previous" buttons
    document.querySelectorAll('.modal-button[data-prev-modal]').forEach(function(button) {
        button.addEventListener('click', function() {
            const currentModal = this.getAttribute('data-current-modal');
            const prevModal = this.getAttribute('data-prev-modal');
            document.getElementById('modal' + currentModal).style.display = 'none';
            document.getElementById('modal' + prevModal).style.display = 'block';
        });
    });
</script>

            </div>
          
            
       @include('/pdrrmo/footer')
          
          </div>
          
        

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  function closeModal(currentModal) {
    document.getElementById(currentModal).style.display = 'none';
}

        function nextModal(currentModal, nextModal) {
            document.getElementById('modal' + currentModal).style.display = 'none';
            document.getElementById('modal' + nextModal).style.display = 'block';
        }

        function prevModal(currentModal, prevModal) {
            document.getElementById('modal' + currentModal).style.display = 'none';
            document.getElementById('modal' + prevModal).style.display = 'block';
        }

        document.getElementById('openModal1').addEventListener('click', function () {
            document.getElementById('modal1').style.display = 'block';
        });

        document.getElementById('openModal2').addEventListener('click', function () {
            document.getElementById('modal2').style.display = 'block';
        });

        document.getElementById('openModal3').addEventListener('click', function () {
            document.getElementById('modal3').style.display = 'block';
        });
        document.getElementById('openModal4').addEventListener('click', function () {
            document.getElementById('modal4').style.display = 'block';
        });
        document.getElementById('openModal5').addEventListener('click', function () {
            document.getElementById('modal5').style.display = 'block';
        });
        document.getElementById('openModal6').addEventListener('click', function () {
            document.getElementById('modal6').style.display = 'block';
        });
        document.getElementById('openModal7').addEventListener('click', function () {
            document.getElementById('modal7').style.display = 'block';
        });
        document.getElementById('openModal8').addEventListener('click', function () {
            document.getElementById('modal8').style.display = 'block';
        });
        document.getElementById('openModal9').addEventListener('click', function () {
            document.getElementById('modal9').style.display = 'block';
        });
        document.getElementById('openModal10').addEventListener('click', function () {
            document.getElementById('modal10').style.display = 'block';
        });
      });
    </script>
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
        $('#table-data').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [[0, 'desc']] // Assuming you want to sort the first column in descending order
        });
    });
</script>


<div class="modal fade right" id="modalList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
<div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger modal-lg" role="document">
  <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header bg-primary bg-primary text-white">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="row container d-flex justify-content-center">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                   <p class="card-description">
                    List of Situational Report
                  </p>
                
                  <br>

                  <div class="table-responsive">
           
                  </div>
                </div>
              </div>
            </div>
            
            </div>
  
            </div>
     
      </div>
  </div>
</div>
