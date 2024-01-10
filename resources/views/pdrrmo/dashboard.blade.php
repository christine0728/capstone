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
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

      <link rel="stylesheet" type="text/css" href="/css/app.css">
  </head>

  <body>

        <div class="wrapper">


        <div class="body-overlay"></div>

        @include('/pdrrmo/nav')

                <!-- Page Content  -->
                <div id="content">
         @include('/pdrrmo/header')
           
              
              <div class="main-content">
        <br>
         <h4 style="text-align: left; margin-left: 1%">Dashboard</h4>
         <div id="weather-toggle" style="cursor: pointer;margin-left: 3%; margin-top: 3%; ">
            <span style="font-weight: bold;">Expand Weather</span>
            <i class="fa fa-chevron-down text-info"></i>

        </div>
        <div class="container weather-container">
              <div class="weather-input">
                <h3>Enter a location Name</h3>
                <input class="city-input" type="text" placeholder="E.g., Binalonan, Santa Barbara">
                <button class="search-btn">Search</button>
                <div class="separator"></div>
                <button class="location-btn">Use Current Location</button>
              </div>
              <div class="weather-data">
                <div class="current-weather">
                  <div class="details">
                    <h2>City Name (Country)</h2>
                    <h6>Temperature: __°C</h6>
                    <h6>Wind: __ M/S</h6>
                    <h6>Humidity: __%</h6>
                  </div>
                </div>

                <div class="days-forecast">
                  <h2>5-Day Forecast</h2>
                  <ul class="weather-cards">
                    <li class="card">
                      <h3>( ______ )</h3>
                      <h6>Temp: __C</h6>
                      <h6>Wind: __ M/S</h6>
                      <h6>Humidity: __%</h6>
                    </li>
                    <li class="card">
                      <h3>( ______ )</h3>
                      <h6>Temp: __C</h6>
                      <h6>Wind: __ M/S</h6>
                      <h6>Humidity: __%</h6>
                    </li>
                    <li class="card">
                      <h3>( ______ )</h3>
                      <h6>Temp: __C</h6>
                      <h6>Wind: __ M/S</h6>
                      <h6>Humidity: __%</h6>
                    </li>
                    <li class="card">
                      <h3>( ______ )</h3>
                      <h6>Temp: __C</h6>
                      <h6>Wind: __ M/S</h6>
                      <h6>Humidity: __%</h6>
                    </li>
                    <li class="card">
                      <h3>( ______ )</h3>
                      <h6>Temp: __C</h6>
                      <h6>Wind: __ M/S</h6>
                      <h6>Humidity: __%</h6>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <center>
            <div class="row" style="margin-left:0.1%">
               <a href="/pdrrmo/personnel">
                <div class="col-lg-4">
                    <div class="card card-stats">
                        <div class="card-header">
                            <div class="icon icon-warning">
                            <i class="fa fa-user" style="font-size: 45px;"></i>


                            </div>
                        </div>
                        <div class="card-content">
                            <p class="category"><strong>Total Personnel</strong></p>
                            <h3 class="card-title">{{ $totalPersonnel }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            <i class="fa fa-info-circle" style="color: #17a2b8; font-size: 20px;"></i> &nbsp; &nbsp; Total Personnel Info
                                <a href="#pablo"></a>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                <a href="/pdrrmo/manage-user">
                <div class="col-lg-4">
                    <div class="card card-stats">
                        <div class="card-header">
                            <div class="icon icon-warning">
                            <i class="fa fa-users" style="font-size: 45px;"></i>
                              
                            </div>
                        </div>
                        <div class="card-content">
                            <p class="category"><strong>Total Users</strong></p>
                            <h3 class="card-title">{{ $allusers }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                             <!-- Info Icon with Size 45 for Font Awesome 4.3.0 -->
                                <i class="fa fa-info-circle" style="color: #17a2b8; font-size: 20px;"></i> &nbsp; &nbsp;
                                Total User Info
                                <a href="#pablo"></a>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                <a href="/pdrrmo/schedule">
                <div class="col-lg-4">
                    <div class="card card-stats">
                        <div class="card-header">
                            <div class="icon icon-warning">
                              <!-- Calendar Icon for Font Awesome 4.3.0 -->
                            <i class="fa fa-calendar" style="font-size: 45px;"></i>

                            </div>
                        </div>
                        <div class="card-content">
                            <p class="category"><strong>Total incoming schedules</strong></p>
                            <h3 class="card-title">{{ $sched }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            <i class="fa fa-info-circle" style="color: #17a2b8; font-size: 20px;"></i> &nbsp; &nbsp;
                                Total User Info Total incoming schedules
                                <a href="#pablo"></a>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div><br>
            </center>
            <div class="col-md-12">
                    <div class="card" style="background: #f2f3f4">
                        <div class="card-body">
                            <h4 style="text-align: left; margin-left: 1%">Summary</h4><br>
                            <div class="row">
                                
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                Assistance Received Requests
                                    <div class="card card-stats">
                                        <div class="card-header">
                                        <div class="icon icon-warning">
                                           <!-- Send Icon for Font Awesome 4.3.0 -->
                                        <i class="fa fa-paper-plane" style=" font-size: 35px;"></i>

                                        </div>


                                        </div>
                                        <div class="card-content">
                                            <p class="category"><strong>Total Request</strong></p>
                                            <h3 class="card-title">{{$totalRecieved}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <br>
                                    <div class="card card-stats">
                                        <div class="card-header">
                                        <div class="icon icon-warning">
                                       <!-- Accepted or Checkmark Icon for Font Awesome 4.3.0 -->
                                        <i class="fa fa-check" style="color: #28a745; font-size: 35px;"></i>

                                        </div>
                                        </div>
                                        <div class="card-content">
                                            <p class="category"><strong>Accepted</strong></p>
                                            <h3 class="card-title">{{$accepted_recieved}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <br>
                                    <div class="card card-stats">
                                        <div class="card-header">
                                        <div class="icon icon-success">
                                        <i class="fa fa-times" style="color: red; font-size: 24px;"></i>

                                        </div>


                                        </div>
                                        <div class="card-content">
                                            <p class="category"><strong>Declined</strong></p>
                                            <h3 class="card-title">{{$declined_recieved}}</h3>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <br>
                                    <div class="card card-stats">
                                        <div class="card-header">
                                        <div class="icon icon-warning">
                                        <i class="fa fa-clock-o" style="color: orange; font-size: 24px;"></i>

                                        </div>

                                        </div>
                                        <div class="card-content">
                                            <p class="category"><strong>Pending</strong></p>
                                            <h3 class="card-title">{{$pending_recieved}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div><br>
            <h4>Charts and Graphs</h4>
        <div id="toggleIncidentCard" style="cursor: pointer;">
            <span style="font-weight: bold;">View Total Count of Occurrence of Each Incident</span>
            <i class="fa fa-chevron-down text-info"></i>
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
            <span style="font-weight: bold;"> View Top Municipality Requesting Assistance</span>
            <i class="fa fa-chevron-down text-info"></i>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="card" style="background: #f2f3f4" id="barangayCard">
                        <div class="card-body">
                            <h3>Top Municipality Requesting Assistance</h3>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
      
       @include('/pdrrmo/footer')
          
         </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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
                    label: 'Request Counts by Municipality',
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
                            text: 'Municipality'
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
    <script>
        const weatherContainer = document.querySelector(".weather-container");
        const weatherToggle = document.getElementById("weather-toggle");

        // Initially hide the 5-day forecast
        weatherContainer.classList.add("collapsed");

        weatherToggle.addEventListener("click", () => {
            // Toggle the visibility of the 5-day forecast by adding/removing the "collapsed" class
            weatherContainer.classList.toggle("collapsed");

            // Change the button text and icon accordingly
            if (weatherContainer.classList.contains("collapsed")) {
                weatherToggle.innerHTML = '<span style="font-weight: bold;">Expand Weather</span><i class="fa fa-chevron-down text-info"></i>';
            } else {
                weatherToggle.innerHTML = '<span style="font-weight: bold;">Collapse Weather</span><i class="fa fa-chevron-down text-info"></i>';
            }
        });
    </script>

    <script>
        const cityInput = document.querySelector(".city-input");
    const searchButton = document.querySelector(".search-btn");
    const locationButton = document.querySelector(".location-btn");
    const currentWeatherDiv = document.querySelector(".current-weather");
    const weatherCardsDiv = document.querySelector(".weather-cards");

    const API_KEY = "09fc353ce3870a22cf5dad9a6ddf4df7"; // API key for OpenWeatherMap API
    const defaultCity = "Pangasinan";
    const defaultLatitude = 15.9839; // Replace with the actual latitude of Pangasinan
    const defaultLongitude = 120.6337;

    const createWeatherCard = (cityName, weatherItem, index) => {
        const formattedDate = formatDate(weatherItem.dt_txt);
        if(index === 0) { // HTML for the main weather card
            return `<div class="details">
                        <h2>${cityName} (${formattedDate})</h2>
                        <h6>Temperature: ${(weatherItem.main.temp - 273.15).toFixed(2)}°C</h6>
                        <h6>Wind: ${weatherItem.wind.speed} M/S</h6>
                        <h6>Humidity: ${weatherItem.main.humidity}%</h6>
                    </div>
                    <div class="icon">
                        <img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}@4x.png" alt="weather-icon">
                        <h6>${weatherItem.weather[0].description}</h6>
                    </div>`;
        } else { // HTML for the other five day forecast card
            return `<li class="card">
                        <h3 style="font-size: 12px">(${formattedDate})</h3>
                        <img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}@4x.png" alt="weather-icon">
                        <h6 style="font-size: 12px">Temp: ${(weatherItem.main.temp - 273.15).toFixed(2)}°C</h6>
                        <h6 style="font-size: 12px">Wind: ${weatherItem.wind.speed} M/S</h6>
                        <h6 style="font-size: 12px">Humidity: ${weatherItem.main.humidity}%</h6>
                    </li>`;
        }
    }

    const getWeatherDetails = (cityName, latitude, longitude) => {
        const WEATHER_API_URL = `https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&appid=${API_KEY}`;

        fetch(WEATHER_API_URL).then(response => response.json()).then(data => {
            // Filter the forecasts to get only one forecast per day
            const uniqueForecastDays = [];
            const fiveDaysForecast = data.list.filter(forecast => {
                const forecastDate = new Date(forecast.dt_txt).getDate();
                if (!uniqueForecastDays.includes(forecastDate)) {
                    return uniqueForecastDays.push(forecastDate);
                }
            });

            // Clearing previous weather data
            cityInput.value = "";
            currentWeatherDiv.innerHTML = "";
            weatherCardsDiv.innerHTML = "";

            // Creating weather cards and adding them to the DOM
            fiveDaysForecast.forEach((weatherItem, index) => {
                const html = createWeatherCard(cityName, weatherItem, index);
                if (index === 0) {
                    currentWeatherDiv.insertAdjacentHTML("beforeend", html);
                } else {
                    weatherCardsDiv.insertAdjacentHTML("beforeend", html);
                }
            });        
        }).catch(() => {
            alert("An error occurred while fetching the weather forecast!");
        });
    }
    function formatDate(dateStr) {
        const options = { weekday: 'long',  day: 'numeric', month: 'long', year: 'numeric' };
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', options);
    }
    const getCityCoordinates = () => {
        const cityName = cityInput.value.trim();
        if (cityName === "") return;
        const API_URL = `https://api.openweathermap.org/geo/1.0/direct?q=${cityName}&limit=1&appid=${API_KEY}`;
        
        // Get entered city coordinates (latitude, longitude, and name) from the API response
        fetch(API_URL).then(response => response.json()).then(data => {
            if (!data.length) return alert(`No coordinates found for ${cityName}`);
            const { lat, lon, name } = data[0];
            getWeatherDetails(name, lat, lon);
        }).catch(() => {
            alert("An error occurred while fetching the coordinates!");
        });
    }

    const getUserCoordinates = () => {
        navigator.geolocation.getCurrentPosition(
            position => {
                const { latitude, longitude } = position.coords; // Get coordinates of user location
                // Get city name from coordinates using reverse geocoding API
                const API_URL = `https://api.openweathermap.org/geo/1.0/reverse?lat=${latitude}&lon=${longitude}&limit=1&appid=${API_KEY}`;
                fetch(API_URL).then(response => response.json()).then(data => {
                    const { name } = data[0];
                    getWeatherDetails(name, latitude, longitude);
                }).catch(() => {
                    alert("An error occurred while fetching the city name!");
                });
            },
            error => { // Show alert if user denied the location permission
                if (error.code === error.PERMISSION_DENIED) {
                    alert("Geolocation request denied. Please reset location permission to grant access again.");
                } else {
                    alert("Geolocation request error. Please reset location permission.");
                }
            });
    }

    locationButton.addEventListener("click", getUserCoordinates);
    searchButton.addEventListener("click", getCityCoordinates);
    document.addEventListener("DOMContentLoaded", () => {
        getWeatherDetails(defaultCity, defaultLatitude, defaultLongitude);
    });
    cityInput.addEventListener("keyup", e => e.key === "Enter" && getCityCoordinates());
    </script>
</body>
</html>


