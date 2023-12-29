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

      <!-- Include your custom CSS file (if you have one) -->
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    

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
                  <h3>Situational Report</h3><br>
           
                  <button id="openModal1" class="btn btn-primary" >Add sitrep</button><br><br>
                  <form action="/mdrrmo/filter-sitrep" method="GET" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date:</label>&nbsp;
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>&nbsp;

                      <div class="form-group">
                          <label for="end_date">End Date:</label>&nbsp;
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>&nbsp;

                      <button type="submit" class="btn btn-primary">Apply Filter</button>&nbsp;
                      <a href="/mdrrmo/sitrep" class="btn btn-secondary">All</a>
                  </form> <br>
                  
                  <div class="table-responsive">
                  <table class="table" >
                      <thead>
                        <tr>
                  
                        <th style="width: 270px;">Subject</th>
                        <th style="width: 150px;">Date Created</th>
              
                        <th style="width: 150px;">Date Finalized</th>
                        <th style="width: 150px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse ($sitreps as $sitrep)
               <tr>
              
               <td>{{ $sitrep->subject_name }}</td>
             
               <td>{{ date('F d, Y g:ia', strtotime($sitrep->created_at )) }}</td>
               <td>
                    @if ($sitrep->finalized_at)
                        <span style="color: red;">Finalized</span>
                    @else
                        Not yet finalized
                    @endif
                </td>

               <td>     
                <div class="btn-group" role="group">
                   
                 
                <a class="btn btn-primary btn-xs" href="{{ route('sitrep.details', ['id' => $sitrep->id]) }}">
                        <i style="color: white; font-size: 12px;" class="fas fa-eye"></i>
                    </a>
               &nbsp;
    @if ($sitrep->finalized_at)
    <a class="btn btn-secondary btn-xs" href="" style="pointer-events: none;">
    <i style="color: white; font-size: 12px;" class="fas fa-edit"></i>
</a>

    @else
    
    <button class="btn btn-success btn-xs" href="">
            <i style="color: white; font-size: 12px;" class="fas fa-edit"></i>
           </button>
    @endif
</td>
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
          


   
    

<form action="/mdrrmo/submit-sitrep" method="post" enctype="multipart/form-data">
     @csrf
<div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
          <h4  class="heading">SITUATIONAL REPORT</h4> <br>

            <button type="button" class="close" aria-label="Close"  onclick="closeModal('modal1')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
           <div class="modal-body">
           <div class="form-group">
            <label for="attn" >ATTN</label>
            <input type="text" class="form-control" id="attn" name="attn" value="PDRRMO" readonly required>
        </div>

        <div class="form-group" style="width: 100%">
    <label class="req-label">Select a subject:</label>
    <select id="subject" name="subject" class="form-control" style="color: black;">
        <option value="" selected disabled>Select subject</option>
        
        @foreach ($subjects as $subject)
            <option value="{{ $subject['id'] }}" style="color: black;">{{ $subject['subject'] }}</option>
        @endforeach
    </select>
    @error('subject')
        <div class="text-danger text-sm">{{ $message }}</div><br>
    @enderror
</div>




        <div class="form-group">
            <label for="from" >FROM:</label>
            <input type="text" class="form-control" id="from" name="from" value="MDRRMO-{{ $username }}" readonly required>

        </div>
           </div>
           <div class="modal-footer">
      <div class="button-container">
      <button type="button" class="modal-button btn btn-primary" onclick="validateAndNext()">Next</button>
        
         
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
          <div class="modal-header bg-primary text-white">
         <br> <h4>I.Situation Summary</h4>
         <button type="button" class="close" aria-label="Close"  onclick="closeModal('modal2')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
        
          
           <h5>A. General Weather Condition</h5>

        <div class="form-group">
            <label for="province">Province<span style="color:red"> *</label>
            <input type="text" class="form-control" id="province" name="province" value="{{ $username }}, Pangasinan" readonly>
        </div>

        <div class="form-group">
            <label for="general_weather_condition">General Weather Situation<span style="color:red"> *</label>
            <textarea class="form-control" id="general_weather_condition" name="general_weather_condition" required></textarea>
        </div>

        <div class="form-group">
            <label for="tcws">TCWS</label>
            <textarea class="form-control" id="tcws" name="tcws"></textarea>
</div>

              <div class="modal-footer">
                   <div class="button-container">
                   <button type="button" class="modal-button btn btn-secondary" data-current-modal="2" data-prev-modal="1">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="validate()">Next</button>
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



  <div class="modal" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-primary text-white">
                    <br>
                    <h4>B.Dam Situation</h4>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal3')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                <div class="form-group">
                        <label for="spilling_level">Dam</label>
                        <input class="form-control" type="text" name="dam" id="dam">
                    </div>
                    <div class="form-group">
                        <label for="spilling_level">Spilling level</label>
                        <input class="form-control" type="text" name="spilling_level" id="spilling_level">
                    </div>
                    <div class="form-group">
                        <label for="date_and_time">Date and time<span style="color:red"> *</span></label>
                        <input class="form-control" type="datetime-local" id="date_and_time" name="date_and_time" >
                    </div>
                    <div class="form-group">
                        <label for="current_level">Current level<span style="color:red"> *</span></label>
                        <input type="text" class="form-control" id="current_level" name="current_level">
                    </div>
                    <div class="form-group">
                        <label for="opening_of_gate">Opening of Gates</label>
                        <div>
                            <input type="radio" id="yes" name="opening_of_gate" value="1">
                            <label for="yes" style="margin-right: 10px;">Yes</label> <!-- Add margin to the right -->
                            <input type="radio" id="no" name="opening_of_gate" value="0">
                            <label for="no" >No</label> <!-- Add margin to the right -->
      
                            
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="button-container">
                            <button type="button" class="modal-button btn btn-secondary" data-current-modal="3" data-prev-modal="2">Previous</button>
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
          <div class="modal-header bg-primary text-white">
          <h4  class="heading">II. EFFECTS</h4> <br>
          <button type="button" class="close" aria-label="Close"  onclick="closeModal('modal4')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
          <div class="form-group">
          <h5>A. Related incidents</h5>
          <input type="text" class="form-control" id="related_incident" name="related_incident"  >
            </div>
<div class="form-group">
    <h5>B. Total of affected families</h5>
    <input class="form-control" type="number" id="affected_population" name="affected_population" >
</div>

        <div class="form-group">
          <h5>C. Casualties</h5>
          <input class="form-control" type="text" id="casualties" name="casualties">
        </div>
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
  
  </div>

<div class="modal" id="modal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal5')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" style="max-height: 90vh; overflow-y: auto;">
                    <h5>D. Status of Lifelines</h5>
                    <div class="form-group">
                        <label for="road_not_passable_all_type">Baranggay Road Not Passable (All Types)</label>
                        <input class="form-control" type="number" id="road_not_passable_all_type" name="road_not_passable_all_type" placeholder="Enter value">
                    </div>

                    <div class="form-group">
                        <label for="road_passable_all_light">Baranggay Road Passable (All Light vehicles)</label>
                        <input class="form-control" type="number" id="road_passable_all_light" name="road_passable_all_light" placeholder="Enter value">
                    </div>

                    <div class="form-group">
                        <label for="road_passable_all_type">Baranggay Road Passable (All Types of vehicle)</label>
                        <input class="form-control" type="number" id="road_passable_all_type" name="road_passable_all_type" placeholder="Enter value">
                    </div>

                    <div class="form-group">
                        <label for="bridge_not_passable_all_type">Bridge Not Passable (All Types of vehicles)</label>
                        <input class="form-control" type="number" id="bridge_not_passable_all_type" name="bridge_not_passable_all_type" placeholder="Enter value">
                    </div>

                    <div class="form-group">
                        <label for="bridge_passable_all_light">Bridge Passable (All Light vehicles)</label>
                        <input class="form-control" type="number" id="bridge_passable_all_light" name="bridge_passable_all_light" placeholder="Enter value">
                    </div>
                    

                    
                    <div class="form-group">
                        <label for="power">b.Power</label>
                        <input class="form-control" type="TEXT" id="power" name="power" >
                    </div>

                    <div class="form-group">
                        <label for="water">c.Water</label>
                        <input class="form-control" type="text" id="water" name="water" >
                    </div>

                    <div class="form-group">
                        <label for="communication_lines">d.Communication lines </label>
                        <input class="form-control" type="text" id="communication_lines" name="communication_lines" >
                    </div>
                    <br>
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
</div>

<div class="modal" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal6')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                    <h5>E. Status of Ports</h5>
                    <div class="form-group">
                    <label for="status_of_airports" style="text-transform: none;">a. Status of Airports</label>
                    <input class="form-control" type="text" name="status_of_airports" id="status_of_airports">
                </div>

                <div class="form-group">
                    <label for="status_of_flights" style="text-transform: none;">b. Status of Flights</label>
                    <input class="form-control" type="text" name="status_of_flights" id="status_of_flights">
                </div>

                <div class="form-group">
                    <label for="status_of_seaports" style="text-transform: none;">c. Status of Seaports</label>
                    <input class="form-control" type="text" name="status_of_seaports" id="status_of_seaports">
                </div>

                <div class="form-group">
                    <label for="stranded_passengers" style="text-transform: none;">d. Stranded Passengers, ROLLING CARGOES, VESSELS, MOTORBANCAS</label>
                    <input class="form-control" type="text" name="stranded_passengers" id="stranded_passengers">
                </div>


                    <br>
                    <div class="modal-footer">
                        <div class="button-container">
                            <button type="button" class="modal-button btn btn-secondary" data-current-modal="6" data-prev-modal="5">Previous</button>
                            <button type="button" class="modal-button btn btn-primary" onclick="nextModal(6, 7)">Next</button>
                        </div>
                        <div class="page-indicator">
                            Page 5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
  </div>
  
<div class="modal" id="modal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal7')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" style="max-height: 90vh; overflow-y: auto;">
                    <h5>F. Damaged houses </h5>
                    <div class="form-group">
                        <label for="partial_damaged_house">Partially damage house (All Types)</label>
                        <input class="form-control" type="number" id="partial_damaged_house" name="partial_damaged_house" placeholder="Enter value">
                    </div>

                    <div class="form-group">
                        <label for="total_damaged_house">Totally damaged house</label>
                        <input class="form-control" type="number" id="total_damaged_house" name="total_damaged_house" placeholder="Enter value">
                    </div>
                    <br>
                    <h5>G. Cost of Damages </h5>
                    <SPAN>A. Damage to agriculture </SPAN>
                    <div class="form-group">
                        <label for="damage_to_agriculture">Total worth of Damage to agriculture</label>
                        <input class="form-control" type="number" id="damage_to_agriculture" name="damage_to_agriculture" placeholder="Enter value">
                    </div>
                    <div class="form-group">
                        <label for="damage_to_livestock">Total worth of Damage to livestock</label>
                        <input class="form-control" type="number" id="damage_to_livestock" name="damage_to_livestock" placeholder="Enter value">
                    </div>
                    <SPAN>B. Damage to Infrastructure </SPAN>
                    <div class="form-group">
                        <label for="damage_to_infrastructure">Totally worth of damage to infrastructure</label>
                        <input class="form-control" type="number" id="damage_to_infrastructure" name="damage_to_infrastructure" placeholder="Enter value">
                    </div>
                    <div class="modal-footer">
                        <div class="button-container">
                            <button type="button" class="modal-button btn btn-secondary" data-current-modal="7" data-prev-modal="6">Previous</button>
                            <button type="button" class="modal-button btn btn-primary" onclick="nextModal(7, 8)">Next</button>
                        </div>
                        <div class="page-indicator">
                            Page 7
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal8')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <div class="form-group">
                      <h5>H. Class Suspension</h5>
                      <label>
                          <input type="radio" name="class_suspension" value="1" required> Yes
                      </label>
                      <label>
                          <input type="radio" name="class_suspension" value="0" required> No
                      </label>
                                   </div>

                  <div class="form-group">
                      <h5>I. Work Suspension</h5>
                      <label>
                          <input type="radio" name="work_suspension" value="1" required> Yes
                      </label>
                      <label>
                          <input type="radio" name="work_suspension" value="0" required> No
                      </label>
                  </div>

                  <div class="form-group">
                      <h5>J. State of Calamity</h5>
                      <label>
                          <input type="radio" name="state_of_calamity" value="1"> Yes
                      </label>
                      <label>
                          <input type="radio" name="state_of_calamity" value="0" > No
                      </label>
                       </div>

                  <div class="form-group">
                      <h5>K. Pre-emptive Evacuation</h5>
                        <label>
                          <input type="text" name="preemptive_evacuation" class="form-control">
                      </label>
              
                    </div>

                  <div class="form-group">
                      <h5>L. Pre-emptive Evacuation (Animals)</label>
                      <label>
                          <input type="text" name="preemptive_evacuation_animals" class="form-control">
                      </label>
               
                    </div>
                  <div class="form-group">
                      <h5>M. Assistance Provided</h5>
                      <label>
                          <input type="text" name="assistance_provided" class="form-control" >
                      </label>
               
                  </div>
                    <br>
                    <div class="modal-footer">
                        <div class="button-container">
                            <button type="button" class="modal-button btn btn-secondary" data-current-modal="8" data-prev-modal="7">Previous</button>
                            <button type="button" class="modal-button btn btn-primary" onclick="nextModal(8, 9)">Next</button>
                        </div>
                        <div class="page-indicator">
                            Page 8
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
  </div>

  <div class="modal" id="modal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
            <h3 class="heading">III.Disaster preparedness</h3>
            <button type="button" class="close"  aria-label="Close"  onclick="closeModal('modal9')">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
         
           <div class="form-group">
    <h5>Disaster Preparedness</h5>
    <textarea class="form-control" id="disaster_preparedness" name="disaster_preparedness" rows="5"></textarea>
</div>

        
            <br>
              <div class="modal-footer">
                   <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="9" data-prev-modal="8">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(9, 10)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 9
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal('modal10')">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                <h5>Disaster Response</h5>
                    <div class="form-group">
                        <label for="food_and_non_food" style="text-transform: none;">a. Food and Non-food</label>
                        <textarea class="form-control" id="food_and_non_food" name="food_and_non_food"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pccm" style="text-transform: none;">b. PROTECTION, CAMP COORDINATION AND MANAGEMENT (PCCM)</label>
                        <textarea class="form-control" id="pccm" name="pccm"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="health" style="text-transform: none;">c. Health(WASH, MEDICAL, NUTRITION AND MEDICAL)</label>
                        <textarea class="form-control" id="health" name="health"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="search_rescue_retrieval" style="text-transform: none;">d. Search Rescue and Retrieval</label>
                        <textarea class="form-control" id="search_rescue_retrieval" name="search_rescue_retrieval"></textarea>
                    </div>
                    <br>

                </div>
                <div class="modal-footer">
                    <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="10" data-prev-modal="9">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(10, 11)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 10
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content" style="max-height: 80vh; overflow-y: auto;">
        <!--Header-->
        <div class="modal-header bg-primary text-white">
          <h3 class="heading">III. DISASTER PREPAREDNESS</h3>
          <button type="button" class="close" aria-label="Close" onclick="closeModal('modal11')">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
        <div class="form-group">
            <label for="logistics" style="text-transform: none;">e. Logistics</label>
            <textarea class="form-control" id="logistics" name="logistics"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="emergency_telecommunications" style="text-transform: none;">f. Emergency Telecommunication</label>
            <textarea class="form-control" id="emergency_telecommunications" name="emergency_telecommunications"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="education" style="text-transform: none;">g. Education</label>
            <textarea class="form-control" id="education" name="education"></textarea>
          </div>
          <div class="form-group">
            <label for="clearing_operation" style="text-transform: none;">h. CLEARING OPERATIONS</label>
            <textarea class="form-control" id="clearing_operations" name="clearing_operations"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="damage_assessment_needs_analysis" style="text-transform: none;">i. Damage Assessment & Needs Analysis</label>
            <textarea class="form-control" id="damage_assessment_needs_analysis" name="damage_assessment_needs_analysis"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="law_order" style="text-transform: none;">j. Law & Order</label>
            <textarea class="form-control" id="law_order" name="law_order"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <div class="button-container">
          <button type="button" class="modal-button btn btn-secondary" data-current-modal="11" data-prev-modal="10">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(11, 12)">Next</button>
                    </div>
          <div class="page-indicator">
              Page 10
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="modal" id="modal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content" style="max-height: 80vh; overflow-y: auto;">
        <!--Header-->
        <div class="modal-header bg-primary text-white">
         
          <button type="button" class="close" aria-label="Close" onclick="closeModal('modal12')">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
        <div class="form-group">
                      <label class="req-label">Select a officer:</label>
                      <select id="sitrepDeveloperId" name="sitrepDeveloperId" class="form-control">
                        <option value="" selected disabled>Select a officer</option>
                        
                        <?php foreach ($personnels as $personnel): ?>
                            <option value="<?= $personnel['id'] ?>"><?= $personnel['fullname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                      @error('category')
                      <div class="text-sm" style="color: red;">{{ $message }}</div>
<br>
                      @enderror
                    </div>
          <div>
            <label for="">Upload Esignature</label>
            <input type="file" name="image-prepared" id="image-prepared" class="course form-control">
            <img src="" id="preview-prepared" width="50px" height="50px">
            @error('image')
              <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <br>
          <div class="form-group">
                      <label class="req-label">Select a officer:</label>
                      <select id="ldrrmoId" name="ldrrmoId" class="form-control">
                        <option value="" selected disabled>Select a officer</option>
                        
                        <?php foreach ($personnels as $personnel): ?>
                            <option value="<?= $personnel['id'] ?>"><?= $personnel['fullname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                      @error('category')
                      <div class="text-sm" style="color: red;">{{ $message }}</div>
<br>
                      @enderror
                    </div>
          <div>
          <div>
            <label for="">Upload Esignature</label>
            <input type="file" name="image-ldrrmo" id="image-ldrrmo" class="course form-control">
            <img src="" id="preview-ldrrmo" width="50px" height="50px">
            @error('image')
              <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <div class="button-container">
          <button type="button" class="modal-button btn btn-secondary" data-current-modal="12" data-prev-modal="11">Previous</button>
            <button type="submit" class="modal-button btn btn-primary" >Submit</button>
      </div>
          <div class="page-indicator">
              Page 10
          </div>
        </div>
      </div>
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
          url: '/mdrrmo/destroy-sitrep/', 
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function (response) {
            // Display success message
            Swal.fire(
              'Deleted!',
              'The report has been deleted.',
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
              'An error occurred while deleting this report.',
              'error'
            );
          }
        });
      }
    });
  }
</script>
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
          url: '/mdrrmo/destroy-sitrep/' + id, 
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function (response) {
            // Display success message
            Swal.fire(
              'Deleted!',
              'The report has been deleted.',
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
              'An error occurred while deleting this report.',
              'error'
            );
          }
        });
      }
    });
  }
</script>

            </div>
          
            
       @include('/mdrrmo/footer')
          
          </div>
          
        

    </div>

<!-- Include jQuery (you can change the version if needed) -->
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>

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


<div class="modal fade right" id="modalList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
<div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger modal-lg" role="document">
  <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title">Export</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="row container d-flex justify-content-center">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form action="/pdrrmo/filter-sitrep" method="GET" class="form-inline">
                      <div class="form-group">
                          <label for="start_date">Start Date:</label>
                          <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $start_date ?? 'YYYY-MM-DD') }}">
                      </div>

                      <div class="form-group">
                          <label for="end_date">End Date:</label>
                          <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $end_date ?? 'YYYY-MM-DD') }}">
                      </div>
                      &nbsp;
                      <button type="submit" class="btn btn-primary">Apply Filter</button>&nbsp;
                      <a href="/pdrrmo/sitrep" class="btn btn-secondary">All</a>
                  </form>
                  <br><br>
                  <h5>
                    List of Situational Report
                  </h5><br>
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
  
<form action="/mdrrmo/edit-sitrep" method="post" >
     @csrf
     <div class="modal" id="modal55" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
          <h4  class="heading">SITUATIONAL REPORT</h4> <br>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
          </div>
           <div class="modal-body">
           <div class="form-group">
            <textarea class="form-control" id="id" name="id" hidden></textarea>
            <label for="subject" >ATTN</label>
            <input type="text" class="form-control" id="editattn" name="editattn" value="PDRRMO" readonly required>
        </div>
        <div class="form-group">
            <label for="subject" >Subject<span style="color:red"> *</span></label>
            <textarea class="form-control" id="editsubject" name="editsubject" required></textarea>
        </div>
        <div class="form-group">
            <label for="subject" >FROM:</label>
            <input type="text" class="form-control" id="editfrom" name="editfrom" value="MDRRMO-{{ $username }}" readonly required>

        </div>
  

      
           </div>
           <div class="modal-footer">
      <div class="button-container">
          <button type="button" class="modal-button btn btn-primary" onclick="nextModal(11, 12)">Next</button>
      </div>
      <div class="page-indicator">
          Page 1
      </div>
  </div>

      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
          <h4  class="heading">I. SITUATION SUMMARY</h4> <br>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
          </div>
           <div class="modal-body">
            <h5>A. General Weather Condition</h5>
        <div class="form-group">
            <label for="province">Province<span style="color:red"> *</label>
            <input type="text" class="form-control" id="editprovince" name="editprovince" required>
        </div>
           <div class="form-group">
            <label for="general_weather_conditions">General Weather Situation<span style="color:red"> *</label>
            <textarea class="form-control" id="editgeneral_weather_condition" name="editgeneral_weather_condition"></textarea>
        </div>
        <div class="form-group">
            <label for="tcws">Tcws</label>
            <textarea class="form-control" id="edittcws" name="edittcws"></textarea>
        </div>
        <div class="form-group">
            <h5>B. Dam Situation</h5>
            <textarea class="form-control" id="editdam_situation" name="editdam_situation"></textarea>
        </div>
      
           </div>
           <div class="modal-footer">
      <div class="button-container">
        <button type="button" class="modal-button btn btn-secondary" data-current-modal="12" data-prev-modal="11">Previous</button>
          <button type="button" class="modal-button btn btn-primary" onclick="nextModal(12, 13)">Next</button>
      </div>
      <div class="page-indicator">
          Page 2
      </div>
  </div>

      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
          <h4  class="heading">II. EFFECTS</h4> <br>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
        
           <div class="form-group">
          <h5>A. Related Incident</h5>
          <textarea class="form-control" id="editrelated_incident" name="editrelated_incident"></textarea>
        </div>
        <div class="form-group">
          <h5>B. Affected Population</h5>
          <textarea class="form-control" id="editaffected_population" name="editaffected_population"></textarea>
        </div>
        <div class="form-group">
          <h5>C. Casualties</h5>
          <textarea class="form-control" id="editcasualties" name="editcasualties"></textarea>
        </div>
              <div class="modal-footer">
                   <div class="button-container">
                   <button type="button" class="modal-button btn btn-secondary" data-current-modal="13" data-prev-modal="12">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(13, 14)">Next</button>
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
  <div class="modal" id="modal14" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
            <h3 class="heading">II. EFFECTS</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
          <h5>D. Status of Lifelines</h5>
              <div class="form-group">
                <label for="roads_and_bridges" style="text-transform: none;">a. Roads and Bridges</label>
                <textarea class="form-control" id="editroads_and_bridges" name="editroads_and_bridges"></textarea>
              </div>

              <div class="form-group">
                <label for="power" style="text-transform: none;">b. Power</label>
                <textarea class="form-control" id="editpower" name="editpower"></textarea>
              </div>

              <div class="form-group">
                <label for="water" style="text-transform: none;">c. Water</label>
                <textarea class="form-control" id="editwater" name="editwater"></textarea>
              </div>

              <div class="form-group">
                <label for="communication_lines" style="text-transform: none;">d. Communication Lines</label>
                <textarea class="form-control" id="editcommunication_lines" name="editcommunication_lines"></textarea>
            </div>
     
            <br>
              <div class="modal-footer">
                   <div class="button-container">
                   <button type="button"class="modal-button btn btn-secondary" data-current-modal="14" data-prev-modal="13">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(14, 15)">Next</button>
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
  
  <div class="modal" id="modal15" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
            <h3 class="heading">II. EFFECTS</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
           <div class="form-group">
            <h5>E. Status of Ports</h5>
        </div>

        <div class="form-group">
            <label for="status_of_airports" style="text-transform: none;">a. Status of Airports</label>
            <textarea class="form-control" name="editstatus_of_airports" id="editstatus_of_airports"></textarea>
        </div>

        <div class="form-group">
            <label for="status_of_flights" style="text-transform: none;">b. Status of Flights</label>
            <textarea class="form-control" name="editstatus_of_flights" id="editstatus_of_flights"></textarea>
        </div>

        <div class="form-group">
            <label for="status_of_seaports" style="text-transform: none;">c. Status of Seaports</label>
            <textarea class="form-control" name="editstatus_of_seaports" id="editstatus_of_seaports"></textarea>
        </div>

        <div class="form-group">
            <label for="stranded_passengers" style="text-transform: none;">d. Stranded Passengers, ROLLING CARGOES, VESSELS, MOTORBANCAS</label>
            <textarea class="form-control" name="editstranded_passengers" id="editstranded_passengers"></textarea>
        </div>

            <br>
              <div class="modal-footer">
                   <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="15" data-prev-modal="14">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(15, 16)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 5
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal16" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true" data-backdrop="true">
      <div id="modalContainer">
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header bg-primary text-white">
            <h3 class="heading">II. EFFECTS</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>
          <!--Body-->
 
           <div class="modal-body"> 
           <div class="form-group">
              <h5>F. Damaged Houses</h5>
              <textarea class="form-control" id="editdamaged_house" name="editdamaged_house"></textarea>
            </div>

            <div class="form-group">
              <h5>G. Cost of Damages</h5>
            </div>

            <div class="form-group">
              <label for="damage_to_agriculture" style="text-transform: none;">a. Damage to Agriculture</label>
              <textarea class="form-control" id="editdamage_to_agriculture" name="editdamage_to_agriculture"></textarea>
            </div>

            <div class="form-group">
              <label for="damage_to_infrastructure" style="text-transform: none;">b. Damage to Infrastructure</label>
              <textarea class="form-control" id="editdamage_to_infrastructure" name="editdamage_to_infrastructure"></textarea>
            </div>
            <br>
              <div class="modal-footer">
                   <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="16" data-prev-modal="15">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(16, 17)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 6
                    </div>
              </div>
              </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal" id="modal17" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">II. EFFECTS</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <h5>H. Class Suspension</h5>
                        <textarea class="form-control" id="editclass_suspension" name="editclass_suspension"></textarea>
                    </div>

                    <div class="form-group">
                        <h5>I. Work Suspension</h5>
                        <textarea class="form-control" id="editwork_suspension" name="editwork_suspension"></textarea>
                    </div>

                    <div class="form-group">
                        <h5>J. State of Calamity</h5>
                        <textarea class= "form-control" id="editstate_of_calamity" name="editstate_of_calamity"></textarea>
                    </div>

                    <div class="form-group">
                        <h5>K. Pre-emptive Evacuation</h5>
                        <textarea class="form-control" id="editpreemptive_evacuation" name="editpreemptive_evacuation"></textarea>
                    </div>

                    <div class="form-group">
                        <h5>L. Pre-emptive Evacuation (Animals)</label>
                        <textarea class="form-control" id="editpreemptive_evacuation_animals" name="editpreemptive_evacuation_animals"></textarea>
                    </div>

                    <div class="form-group">
                        <h5>M. Assistance Provided</label>
                        <textarea class="form-control" id="editassistance_provided" name="editassistance_provided"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="17" data-prev-modal="16">Previous</button>
                        <button type="button" class="modal-button btn btn-primary" onclick="nextModal(17, 18)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 7
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
  <div class="modal" id="modal18" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content" style="max-height: 80vh; overflow-y: auto;">
        <!--Header-->
        <div class="modal-header bg-primary text-white">
          <h3 class="heading">III. DISASTER PREPAREDNESS</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body">
          <div class="form-group">
            <h5>Disaster Preparedness</h5>
            <textarea class="form-control" id="editdisaster_preparedness" name="editdisaster_preparedness" rows="5"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <div class="button-container">
            <button type="button" class="modal-button btn btn-secondary" data-current-modal="18" data-prev-modal="17">Previous</button>
            <button type="button" class="modal-button btn btn-primary" onclick="nextModal(18, 19)">Next</button>
          </div>
          <div class="page-indicator">
              Page 8
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal19" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
    <div id="modalContainer">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h3 class="heading">IV. DISASTER RESPONSE</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    
                    <h5>Disaster Response</h5>
                    <div class="form-group">
                        <label for="food_and_non_food" style="text-transform: none;">a. Food and Non-food</label>
                        <textarea class="form-control" id="editfood_and_non_food" name="editfood_and_non_food"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pccm" style="text-transform: none;">b. PROTECTION, CAMP COORDINATION AND MANAGEMENT (PCCM)</label>
                        <textarea class="form-control" id="editpccm" name="editpccm"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="health" style="text-transform: none;">c. Health(WASH, MEDICAL, NUTRITION AND MEDICAL)</label>
                        <textarea class="form-control" id="edithealth" name="edithealth"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="search_rescue_retrieval" style="text-transform: none;">d. Search Rescue and Retrieval</label>
                        <textarea class="form-control" id="editsearch_rescue_retrieval" name="editsearch_rescue_retrieval"></textarea>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <div class="button-container">
                        <button type="button" class="modal-button btn btn-secondary" data-current-modal="19" data-prev-modal="18">Previous</button>
                        <button type="button"class="modal-button btn btn-primary" onclick="nextModal(19, 20)">Next</button>
                    </div>
                    <div class="page-indicator">
                        Page 9
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="modal20" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div id="modalContainer">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header bg-primary text-white">
          <h3 style="color:white" class="heading">IV. DISASTER RESPONSE</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" style="max-height: 90vh; overflow-y: auto;">
          <div class="form-group">
            <label for="logistics" style="text-transform: none;">e. Logistics</label>
            <textarea class="form-control" id="editlogistics" name="editlogistics"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="emergency_telecommunications" style="text-transform: none;">f. Emergency Telecommunication</label>
            <textarea class="form-control" id="editemergency_telecommunications" name="editemergency_telecommunications"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="education" style="text-transform: none;">g. Education</label>
            <textarea class="form-control" id="editeducation" name="editeducation"></textarea>
          </div>
          <div class="form-group">
            <label for="clearing_operation" style="text-transform: none;">h. CLEARING OPERATIONS</label>
            <textarea class="form-control" id="editclearing_operations" name="editclearing_operations"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="damage_assessment_needs_analysis" style="text-transform: none;">i. Damage Assessment & Needs Analysis</label>
            <textarea class="form-control" id="editdamage_assessment_needs_analysis" name="editdamage_assessment_needs_analysis"></textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="law_order" style="text-transform: none;">j. Law & Order</label>
            <textarea class="form-control" id="editlaw_order" name="editlaw_order"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <div class="button-container">
            <button type="button" class="modal-button btn btn-secondary" data-current-modal="20" data-prev-modal="19">Previous</button>
            <button type="submit" class="modal-button btn btn-primary" >Save Changes</button>
          </div>
          <div class="page-indicator">
              Page 10
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</form>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var closeButtons = document.querySelectorAll('.modal .close');
    closeButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        // Find the closest parent modal and hide it
        var modal = button.closest('.modal');
        if (modal) {
          modal.style.display = 'none';
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        }
      });
    });
  });
</script>
<script>
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

<script>
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

        document.getElementById('modal11').addEventListener('click', function () {
            document.getElementById('modal11').style.display = 'block';
        });
        document.getElementById('modal12').addEventListener('click', function () {
            document.getElementById('modal12').style.display = 'block';
        });
        document.getElementById('modal13').addEventListener('click', function () {
            document.getElementById('modal13').style.display = 'block';
        });
        document.getElementById('modal14').addEventListener('click', function () {
            document.getElementById('modal14').style.display = 'block';
        });
        document.getElementById('modal15').addEventListener('click', function () {
            document.getElementById('modal15').style.display = 'block';
        });
        document.getElementById('modal16').addEventListener('click', function () {
            document.getElementById('modal16').style.display = 'block';
        });
        document.getElementById('modal17').addEventListener('click', function () {
            document.getElementById('modal17').style.display = 'block';
        });
    </script>

    <script>
        $('.btn-edit').on('click', function() {
            $('#id').val($(this).data('id'));
            $('#editsubject').val($(this).data('subject'));
            $('#editprovince').val($(this).data('province'));
            $('#editgeneral_weather_condition').val($(this).data('general_weather_condition'));
            $('#edittcws').val($(this).data('tcws'));
            $('#editdam_situation').val($(this).data('dam_situation'));
            $('#editrelated_incident').val($(this).data('related_incident'));
            $('#editaffected_population').val($(this).data('affected_population'));
            $('#editcasualties').val($(this).data('casualties'));
            $('#editroads_and_bridges').val($(this).data('roads_and_bridges'));
            $('#editpower').val($(this).data('power'));
            $('#editwater').val($(this).data('water'));
            $('#editcommunication_lines').val($(this).data('communication_lines'));
            $('#editstatus_of_airports').val($(this).data('status_of_airports'));
            $('#editstatus_of_flights').val($(this).data('status_of_flights'));
            $('#editstatus_of_seaports').val($(this).data('status_of_seaports'));
            $('#editstranded_passengers').val($(this).data('stranded_passengers'));
            $('#editdamaged_house').val($(this).data('damaged_house'));
            $('#editdamage_to_agriculture').val($(this).data('damage_to_agriculture'));
            $('#editdamage_to_infrastructure').val($(this).data('damage_to_infrastructure'));
            $('#editclass_suspension').val($(this).data('class_suspension'));
            $('#editwork_suspension').val($(this).data('work_suspension'));
            $('#editstate_of_calamity').val($(this).data('state_of_calamity'));
            $('#editpreemptive_evacuation').val($(this).data('preemptive_evacuation'));
            $('#editpreemptive_evacuation_animals').val($(this).data('preemptive_evacuation_animals'));
            $('#editassistance_provided').val($(this).data('assistance_provided'));
            $('#editdisaster_preparedness').val($(this).data('disaster_preparedness'));
            $('#editfood_and_non_food').val($(this).data('food_and_non_food'));
            $('#editpccm').val($(this).data('pccm'));
            $('#edithealth').val($(this).data('health'));
            $('#editsearch_rescue_retrieval').val($(this).data('search_rescue_retrieval'));
            $('#editlogistics').val($(this).data('logistics'));
            $('#editemergency_telecommunications').val($(this).data('emergency_telecommunications'));
            $('#editeducation').val($(this).data('education'));
            $('#editclearing_operations').val($(this).data('clearing_operations'));
            $('#editdamage_assessment_needs_analysis').val($(this).data('dage_assessment_needs_analysis'));
            $('#editlaw_order').val($(this).data('law_order'));
        });
    </script>
    @if(session('updatemessage'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'The report has been successfully updated!',
            text: '{{ session('success') }}'
        });
    </script>
    @endif

    @if(session('addmessage'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'The report has been successfully added!',
            text: '{{ session('success') }}'
        });
    </script>
    @endif
    <script>
    // Get the current date and time
    var currentDate = new Date();
    
    // Format the date as "Month day, year H:i A"
    var formattedDate = currentDate.toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    });

    // Set the formatted date as the default value for the input
    document.getElementById('date').value = formattedDate;
</script>

<script>
    function validateAndNext() {
        var selectedSubject = document.getElementById('subject').value;

        if (selectedSubject) {
            // Subject is selected, proceed to the next modal
            nextModal(1, 2);
        } else {
            // Subject is not selected, show an error or alert
            alert('Please select a subject before proceeding.');
            // You can also display an error message on the page instead of using alert
        }
    }
    function validate() {
        var generalWeatherCondition = document.getElementById('general_weather_condition').value;

        if (generalWeatherCondition.trim() !== '') {
            // General Weather Situation is not empty, proceed to the next modal
            nextModal(2, 3);
        } else {
            // General Weather Situation is empty, show an error or alert
            alert('Please provide the General Weather Situation before proceeding.');
            // You can also display an error message on the page instead of using alert
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function () {
    // For the first image input
    $('#image-prepared').change(function () {
      displayImagePreview(this, '#preview-prepared');
    });

    // For the second image input
    $('#image-ldrrmo').change(function () {
      displayImagePreview(this, '#preview-ldrrmo');
    });

    function displayImagePreview(input, previewId) {
      var fileInput = input;
      var preview = $(previewId);

      if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          preview.attr('src', e.target.result);
        };

        reader.readAsDataURL(fileInput.files[0]);
      } else {
        preview.attr('src', '');
      }
    }
  });
</script>
