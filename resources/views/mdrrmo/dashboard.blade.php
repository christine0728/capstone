

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Resquire</title>
      <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
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

    
  </head>

  <body>

<div class="wrapper">


<div class="body-overlay"></div>

@include('/mdrrmo/nav')

        <!-- Page Content  -->
        <div id="content">
 @include('/mdrrmo/header')
   
      
      <div class="main-content">
<br>
 <h4 style="text-align: left; margin-left: 1%">Dashboard</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-warning">
                        <?php
    // Replace 'YOUR_API_KEY' with your actual OpenWeatherMap API key
    $apiKey = '09fc353ce3870a22cf5dad9a6ddf4df7';

    // Replace 'CITY_NAME' with the name of the city you want to get weather data for
    $cityName = 'pangasinan';

    // URL to the OpenWeatherMap API
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$cityName&appid=$apiKey&units=metric";

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the response
    $response = curl_exec($curl);

    // Close cURL session
    curl_close($curl);

    // Check if the API call was successful
    if ($response === false) {
        die('Error: ' . curl_error($curl));
    }

    // Parse the JSON response
    $weatherData = json_decode($response, true);

    // Check if the data was parsed successfully
    if (!$weatherData) {
        die('Error: Unable to parse JSON response.');
    }

    // Extract relevant weather information
    $temperature = $weatherData['main']['temp'];
    $humidity = $weatherData['main']['humidity'];
    $description = $weatherData['weather'][0]['description'];
    $iconCode = $weatherData['weather'][0]['icon'];

    // Build the URL for the weather icon
    $iconUrl = "http://openweathermap.org/img/w/$iconCode.png";

    // Output the weather report
    
    ?>
                        <span class="material-icons" width="100"><img width="100" src="<?php echo $iconUrl; ?>" alt="Weather Icon" class="weather-icon animated-icon"></span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong><?php echo $description; ?></strong></p>
                    <h3 class="card-title">
                            Temperature: <?php echo $temperature; ?> °C<br>
                            Humidity: <?php echo $humidity; ?>%</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i> Current Weather Information
                        <a href="#pablo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-warning">
                        <span class="material-icons">people</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Total Population</strong></p>
                    <h3 class="card-title">{{ $totalPopulation }}</h3> <!-- Replace with the actual total users value -->
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i> Total Population Info
                        <a href="#pablo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <a href="/mdrrmo/personnel">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-warning">
                        <span class="material-icons">people</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Total Personnel</strong></p>
                    <h3 class="card-title">{{ $totalPersonnel }}</h3> <!-- Replace with the actual total personnel value -->
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i> Total Personnel Info
                        <a href="#pablo">

                        </a>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div><br>
    <div class="col-md-12">
            <div class="card" style="background: #f2f3f4">
                <div class="card-body">
                    <h4 style="text-align: left; margin-left: 1%">Summary</h4><br>
                    <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        Assistance Received Requests
                        <a href="/mdrrmo/receive-assistance"> 
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">send</span>
                                </div>


                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Total Request</strong></p>
                                    <h3 class="card-title">{{$totalRecieved}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/assistanceRequest-accepted"> 
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons" style="color: green;">check_circle</span>
                                </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Accepted</strong></p>
                                    <h3 class="card-title">{{$accepted_recieved}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/assistanceRequest-declined"> 
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-success">
                                    <span class="material-icons" style="color: red;">cancel</span>
                                </div>


                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Declined</strong></p>
                                    <h3 class="card-title">{{$declined_recieved}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/assistanceRequest-pending"> 
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">schedule</span>
                                </div>

                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Pending</strong></p>
                                    <h3 class="card-title">{{$pending_recieved}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        Assistance Sent Requests
                        <a href="/mdrrmo/totalsent-req">
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">send</span>
                                </div>


                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Total Request</strong></p>
                                    <h3 class="card-title">{{$allcount}}</h3>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/totalaccepted-req">
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons" style="color: green;">check_circle</span>
                                </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Accepted</strong></p>
                                    <h3 class="card-title">{{$accepted_count}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/totaldeclined-req">
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-success">
                                    <span class="material-icons" style="color: red;">cancel</span>
                                </div>


                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Declined</strong></p>
                                    <h3 class="card-title">{{$declined_count}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <br>
                            <a href="/mdrrmo/totalpending-req">
                            <div class="card card-stats">
                                <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">schedule</span>
                                </div>

                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Pending</strong></p>
                                    <h3 class="card-title">{{$pending_count}}</h3>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><br>
    <h4>Charts and Graphs</h4>
<div id="toggleIncidentCard" style="cursor: pointer;">
    <span style="font-weight: bold;">View Total Count of Occurrence of Each Incident</span>
    <i class="material-icons text-info">arrow_drop_down</i>
</div>

    <div class="row">
    <div class="col-md-12">
            <div class="card" style="background: #f2f3f4" id="incidentCard">
                <div class="card-body">
                    <h3>Total Count of Occurrence of Each Incident  </h3>
                    <canvas id="incidentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<div id="toggleBarangayCard" style="cursor: pointer;">
    <span style="font-weight: bold;"> View Top Barangays Most Affected by the Incidents</span>
    <i class="material-icons text-info">arrow_drop_down</i>
</div>

<div class="row">
    <div class="col-md-12">
            <div class="card" style="background: #f2f3f4" id="barangayCard">
                <div class="card-body">
                    <h3>Top Barangays Most Affected by the Incidents</h3>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

          
      <div class="row">
                 
                    </div>
      
       @include('/mdrrmo/footer')
          
          </div>
          
        

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('incidentChart').getContext('2d');

        // Define an array of background colors
        const backgroundColors = [
            'rgba(75, 192, 192, 0.2)',
        ];

        const incidentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($incidentNames); ?>,
                datasets: [{
                    label: 'Count by Incident', // Set the desired legend label here
                    data: <?php echo json_encode($incidentCounts); ?>,
                    backgroundColor: backgroundColors, // Use the array of background colors
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }],
            },
            options: {
                scales: {
                    y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Incident'
                        }
                    }
                }
            }
        });
    });
</script>
<script>
    // Get the location data from your PHP script
    const locationNames = @json($locationNames);
    const locationCounts = @json($locationCounts);

    // Get the canvas element
    const ctx = document.getElementById('barChart').getContext('2d');

    // Create a bar chart
    const barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: locationNames,
            datasets: [{
                label: 'Incident Counts by Location',
                data: locationCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust color as needed
                borderColor: 'rgba(75, 192, 192, 1)', // Adjust color as needed
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Barangay'
                    }
                }
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Initially, hide the card
        $("#incidentCard").hide();

        // Add a click event to the button
        $("#toggleIncidentCard").click(function() {
            // Toggle the card's visibility
            $("#incidentCard").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Initially, hide the card
        $("#barangayCard").hide();

        // Add a click event to the button
        $("#toggleBarangayCard").click(function() {
            // Toggle the card's visibility
            $("#barangayCard").toggle();
        });
    });
</script>




</body>
</html>


