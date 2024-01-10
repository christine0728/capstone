<!-- resources/views/pdrrmo/file_export.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitreps File Export</title>
    <!-- Add any additional styles or scripts here -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">



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
    @if($sitreps->isEmpty())
        <p>No sitreps found.</p>
    @else
        <div class="page-content page-container" id="page-content">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>Attention</th>
                                            <th>From</th>
                                            <th>Subject ID</th>
                                            <th>Province</th>
                                            <th>General Weather Condition</th>
                                            <th>TCWS</th>
                                            <th>Dam</th>
                                            <th>Date and time</th>
                                            <th>Spilling level</th>
                                            <th>Current level</th>
                                            <th>Opening of gate</th>
                                            <th>Related Incident</th>
                                            <th>Affected Population</th>
                                            <th>Casualties</th>
                                            <th>Roads and Bridges ID</th>
                                            <th>Power</th>
                                            <th>Water</th>
                                            <th>Communication Lines</th>
                                            <th>Status of Airports</th>
                                            <th>Status of Flights</th>
                                            <th>Status of Seaports</th>
                                            <th>Stranded Passengers</th>
                                            <th>Partial Damaged House</th>
                                            <th>Total Damaged House</th>
                                            <th>Damage to Agriculture</th>
                                            <th>Damage to Livestock</th>
                                            <th>Damage to Infrastructure</th>
                                            <th>Work Suspension</th>
                                            <th>State of Calamity</th>
                                            <th>Preemptive Evacuation</th>
                                            <th>Preemptive Evacuation Animals</th>
                                            <th>Assistance Provided</th>
                                            <th>Disaster Preparedness</th>
                                            <th>Food and Non-Food</th>
                                            <th>PCCM</th>
                                            <th>Health</th>
                                            <th>Search Rescue Retrieval</th>
                                            <th>Logistics</th>
                                            <th>Emergency Telecommunications</th>
                                            <th>Education</th>
                                            <th>Clearing Operations</th>
                                            <th>Damage Assessment Needs Analysis</th>
                                            <th>Law Order</th>

                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sitreps as $sitrep)
                                            <tr>
                                                <td>{{ $sitrep->id }}</td>
                                                <td>{{ $sitrep->userId }}</td>
                                                <td>{{ $sitrep->attn }}</td>
                                                <td>{{ $sitrep->from }}</td>
                                                <td>{{ $sitrep->subjectId }}</td>
                                                <td>{{ $sitrep->province }}</td>
                                                <td>{{ $sitrep->general_weather_condition }}</td>
                                                <td>{{ $sitrep->tcws }}</td>
                                                <td>{{ $sitrep->dam }}</td>
                                                <td>{{ $sitrep->date_and_time }}</td>
                                                <td>{{ $sitrep->spilling_level }}</td>
                                                <td>{{ $sitrep->current_level }}</td>
                                                <td>{{ $sitrep->opening_of_gate == 1 ? 'Yes' : 'No' }}</td>
                                                <td>{{ $sitrep->related_incident }}</td>
                                                <td>{{ $sitrep->affected_population }}</td>
                                                <td>{{ $sitrep->casualties }}</td>
                                                <td>
                                                    A total of {{ $sitrep->road_not_passable_all_type }} Road not passable all type OF VEHICLE,
                                                    <br>
                                                    A total of {{ $sitrep->road_passable_all_light }} Road passable all light OF VEHICLE,
                                                    <br>
                                                    A total of {{ $sitrep->road_passable_all_type }} Road passable all type OF VEHICLE,
                                                    <br>
                                                    A total of {{ $sitrep->bridge_not_passable_all_type }} Bridge not passable all type OF VEHICLE,
                                                    <br>
                                                    A total of {{ $sitrep->bridge_passable_all_light }} Bridge passable all light OF VEHICLE
                                                    <!-- Add other road-related information as needed -->
                                                </td>

                                                <td>{{ $sitrep->power }}</td>
                                                <td>{{ $sitrep->water }}</td>
                                                <td>{{ $sitrep->communication_lines }}</td>
                                                <td>{{ $sitrep->status_of_airports }}</td>
                                                <td>{{ $sitrep->status_of_flights }}</td>
                                                <td>{{ $sitrep->status_of_seaports }}</td>
                                                <td>{{ $sitrep->stranded_passengers }}</td>
                                                <td>{{ $sitrep->partial_damaged_house }}</td>
                                                <td>{{ $sitrep->total_damaged_house }}</td>
                                                <td>{{ $sitrep->damage_to_agriculture }}</td>
                                                <td>{{ $sitrep->damage_to_livestock }}</td>
                                                <td>{{ $sitrep->damage_to_infrastructure }}</td>
                                                <td>{{ $sitrep->work_suspension }}</td>
                                                <td>{{ $sitrep->state_of_calamity }}</td>
                                                <td>{{ $sitrep->preemptive_evacuation }}</td>
                                                <td>{{ $sitrep->preemptive_evacuation_animals }}</td>
                                                <td>{{ $sitrep->assistance_provided }}</td>
                                                <td>{{ $sitrep->disaster_preparedness }}</td>
                                                <td>{{ $sitrep->food_and_non_food }}</td>
                                                <td>{{ $sitrep->pccm }}</td>
                                                <td>{{ $sitrep->health }}</td>
                                                <td>{{ $sitrep->search_rescue_retrieval }}</td>
                                                <td>{{ $sitrep->logistics }}</td>
                                                <td>{{ $sitrep->emergency_telecommunications }}</td>
                                                <td>{{ $sitrep->education }}</td>
                                                <td>{{ $sitrep->clearing_operations }}</td>
                                                <td>{{ $sitrep->damage_assessment_needs_analysis }}</td>
                                                <td>{{ $sitrep->law_order }}</td>
                                  
                                                <td>{{ $sitrep->created_at }}</td>
                                                <td>{{ $sitrep->updated_at }}</td>

                                                
                                                <!-- Add other column data here based on your table structure -->
                                                <!-- Repeat this for all columns in your 'sitreps' table -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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