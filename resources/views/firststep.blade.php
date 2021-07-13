<html>
    <head>
        <title>Laravel Google Maps Example</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script defer src="https://maps.googleapis.com/maps/api/js?v=3.42&key=AIzaSyCR_SCnQNk0sMwDbfcrj0PulHJq3YsJqNg&callback=initMap&libraries=places"></script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <!-- DateTime Picker -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link   rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link   rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
       <style>
            #map {
            height: 50%;
            width: 50%;
            }
            /* Optional: Makes the sample page fill the window. */
            html,
            body {
            height: 100%;
            margin: 0;
            padding: 0;
            }
            
            #overlay {
                position: absolute;
                width: 200px;
                height: 450px;
                background: black;
                opacity: 0.8;
                top: 0;
                left: 0;
                overflow: auto;
            }
            #overlayContent {
                color: white;
                padding: 10px 20px;
            }
            #overlayContent p {
                font-size: 12px;
                margin: 6px 0;
            }
            small {
                font-size: 9px;
            }
            #overlayContent small {
                display: block;
                text-align: right;
                font-style: italic;
            }
            input.search-box {
                border: 1px solid #d8d8d8;
                border-radius: 0px;
                box-shadow: none;
                color: #161616;
                display: block;
                font-size: 15px;
                font-weight: 500;
                height: 50px;
                line-height: 1.42857;
                padding: 7px 9px;
                vertical-align: middle;
                outline: none;
                width: 25%;
            }  
            div#datetimepicker1 {
                width: 25%;
            }  
            li#myDIV {
                background-color: #eeeeee;
                color: #000;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                width: 10%;
            }
            span.caret {
                display: none;
            }
            h2.titlePage {
                font-size: 25px;
            }
            a.navbar-brand {
                display: none;
            }
            select#services {
                width: 25%;
            }
            input.btn.btn-info.btn-submit {
                width: 15%;
                position: relative;
                margin: 0 auto;
                left: 65px;
                margin-top: 20px;
            }   
            h2.titlePage {
                margin: 0 auto;
                display: block;
                position: relative;
                left: 60px;
                font-weight: 600;
            } 
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            {{ __('Logout') }}
                                        </a>

                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
            <h2 class="titlePage" data-uw-styling-context="true">Where can we take you?</h2> 
            <form method="post" id="requestForm" >
                {{ csrf_field() }}
                <!-- Form Group -->
                <div class="form-group" id="latitude_Area">
                    <input type="hidden" id="latitude" name="latitude" class="form-control">
                    <input type="hidden" id="latitude1" name="latitude" class="form-control">
                </div>
                <div class="form-group" id="longtitude_Area">
                        <input type="hidden" name="longitude" id="longitude" class="form-control">
                        <input type="hidden" name="longitude" id="longitude1" class="form-control">
                    </div>
                    <div class="form-group" >
                        <label>From</label>
                        <input type="text" name="autocomplete1" id="autocomplete1" class="form-control search-box" placeholder="Type from search addresses" >
                </div>
                <div class="form-group">
                        <label>To</label>
                        <input type="text" name="autocomplete2" id="autocomplete2" class="form-control search-box" placeholder="Type to search addresses" >
                </div>
                <div class="form-group">
                    <label class="control-label">Appointment Time</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="booking_date" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                
                <!-- Services -->
                <div class="form-group">
                    <label class="control-label"> Services </label>
                    <select class="form-control" name="services" id="services" required>
                        <option value="with wheelchair">  With Wheelchair  </option>
                        <option value="with streture">    With Streture  </option>
                        <option value="without services"> Without Services </option>
                    </select>
                </div> 
                <!---------------------------------------------> 
                <!-- Additional Fields Distance and Duration -->
                <!--------------------------------------------->
                <input type="text" name="distance" id="distance"  readonly>
                <input type="text" name="duration" id="duration"  readonly>
                <!--------------------------------------------->
                <!--------------------------------------------->
                <!--------------------------------------------->
                @guest
                    <div id="myDIV" style="display:none;">
                        <input type="button"   onclick="location.href='{{ route('login') }}';" value="Login" />
                    </div>
                @else
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div id="myDIV" style="display:none;">
                        <input type="submit" name="btn" class="btn btn-info btn-submit" value="Book">
                    </div>     
                @endguest
                

            </form>
            <p id="demo"></p>
            <div id="map"></div>
            <!------------------------------------->
            <!--------    Add Table           ----->
            <!------------------------------------->
            <table border="0" cellpadding="0" cellspacing="3">
                <tr>
                    <td colspan="2">
                        <div id="dvDistance">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="dvMap" style="width: 500px; height: 500px">
                        </div>
                    </td>
                    <td>
                        <div id="dvPanel" style="width: 500px; height: 500px">
                        </div>
                    </td>
                </tr>
            </table>
            
        </div>
    </body>
    <script>
            //google.maps.event.addDomListener(window, 'load', initialize);
            window.onload = initialize;
            // set variable value
            var lat1 =  34.0522342;
            var lng1 = -118.2436849;
            var lat2 =  34.4522342;
            var lng2 = -118.6936849;
            
            // initialize 
            function initialize() {
                    // autocomplete 1
                    // var options = {
                    //     types: ['(cities)'],
                    //     componentRestrictions: {country: "us"}
                    // };
                    
                    // place autocomplete restricted with in a city
                    
                    var bangaloreBounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(40.495992, -74.029988),
                        new google.maps.LatLng(40.915568, -73.699215));



                    var options = {
                        bounds: bangaloreBounds,
                        componentRestrictions: {country: 'us'},
                        strictBounds: true,
                    };

                    var input1 = document.getElementById('autocomplete1');
                    var autocomplete1 = new google.maps.places.Autocomplete(input1,options);

                    var input2 = document.getElementById('autocomplete2');
                    var autocomplete2 = new google.maps.places.Autocomplete(input2,options);

                    // autocomplete1 
                    autocomplete1.addListener('place_changed', function () {
                        var place = autocomplete1.getPlace();
                        // set var lat,lng
                        lat1   = place.geometry['location'].lat();
                        lng1   = place.geometry['location'].lng();
                        document.getElementById('latitude').value  = lat1 ;
                        document.getElementById('longitude').value = lng1 ;
                        if(lat1 && lng1){
                            placepoint(place,lat1,lng1);   
                            document.getElementById('autocomplete2').value='';
                            var x = document.getElementById("myDIV");  
                            x.style.display = "none";
                        }
                        
                    });
                    // autocomplete2
                    autocomplete2.addListener('place_changed', function () {
                        var place1 = autocomplete2.getPlace();
                        console.log(place1);
                        lat2   = place1.geometry['location'].lat();
                        lng2   = place1.geometry['location'].lng();
                        document.getElementById('latitude1').value  = lat2 ;
                        document.getElementById('longitude1').value = lng2 ;
                        // check autocomplete1 & autocomplete2
                        var check1 = document.getElementById('autocomplete1');
                        var check2 = document.getElementById('autocomplete2');
                        
                            if(lat2 && lng2){ 
                                initMap();
                                var x = document.getElementById("myDIV");
                                if( check1 && check2 ){
                                    x.style.display = "block";
                                } else {
                                    x.style.display = "none";
                                }
                            }
                            
                    });
            }
            

            // myfunction2 
            function myFunction2() {
                var x = document.getElementById("autocomplete2").value;
                document.getElementById("demo").innerHTML = "You selected: " + x;
            }

            // function place point
            
            function placepoint(place,lat,long) {
                    var coordinates = new google.maps.LatLng(parseFloat(lat),parseFloat(long));
                    console.log(lat);
                    console.log(long);
                    console.log(place);
                    var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 14,
                            center: coordinates,
                            scrollwheel: false
                    });
                    var label = place.formatted_address;
                    var measle = new google.maps.Marker({
                    position: coordinates,
                    map: map,
                    icon: {
                        url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle.png",
                        size: new google.maps.Size(7, 7),
                        anchor: new google.maps.Point(4, 4)
                    }
                    });
                    var marker = new google.maps.Marker({
                    position: coordinates,
                    map: map,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                        labelOrigin: new google.maps.Point(75, 32),
                        size: new google.maps.Size(32,32),
                        anchor: new google.maps.Point(16,32)
                    },
                    label: {
                        text: label,
                        color: "#C70E20",
                        fontWeight: "bold"
                    }
                    });
            }
            

            // function init map contains all functionality including calculate route,set directions, write direction steps,offset maps
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(35.15,-118.12),
                zoom: 11,          
                mapTypeControl: false,
                panControl: false,
                zoomControl: false,
                streetViewControl: false
            });

            // direction service
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map;
            var routeBounds = false;
            var overlayWidth = 200; // Width of the overlay DIV
            var leftMargin = 15; // Grace margin to avoid too close fits on the edge of the overlay
            var rightMargin = 60; // Grace margin to avoid too close fits on the right and leave space for the controls
            overlayWidth += leftMargin;
            
            directionsDisplay = new google.maps.DirectionsRenderer({
                draggable: false
            });

            var mapOptions = {
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: start,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                }
            };

            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            directionsDisplay.setMap(map);

            // function calculate route
            function calcRoute(start,end) {

                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };

                directionsService.route(request, function (response, status) {

                if (status == google.maps.DirectionsStatus.OK) {

                directionsDisplay.setDirections(response);

                // Define route bounds for use in offsetMap function
                routeBounds = response.routes[0].bounds;

                // Write directions steps
                writeDirectionsSteps(response.routes[0].legs[0].steps);

                // Wait for map to be idle before calling offsetMap function
                google.maps.event.addListener(map, 'idle', function () {

                    // Offset map
                    //offsetMap();
                });

                // Listen for directions changes to update bounds and reapply offset
                google.maps.event.addListener(directionsDisplay, 'directions_changed', function () {

                    // Get the updated route directions response
                    var updatedResponse = directionsDisplay.getDirections();

                    // Update route bounds
                    routeBounds = updatedResponse.routes[0].bounds;

                    // Fit updated bounds
                    map.fitBounds(routeBounds);

                    // Write directions steps
                    //writeDirectionsSteps(updatedResponse.routes[0].legs[0].steps);

                    // Offset map
                    //offsetMap();
                });
            }

            // function write direction steps
            function writeDirectionsSteps(steps) {

                // var overlayContent = document.getElementById("overlayContent");
                // overlayContent.innerHTML = 'hi';
                // document.getElementById('overlayContent').innerHTML = 'hi';

                // for (var i = 0; i < steps.length; i++) {

                //     overlayContent.innerHTML += '<p>' + steps[i].instructions + '</p><small>' + steps[i].distance.text + '</small>';
                // }
            }

            // function with offset map
            function offsetMap() {
                if (routeBounds !== false) {

                    // Clear listener defined in directions results
                    google.maps.event.clearListeners(map, 'idle');

                    // Top right corner
                    var topRightCorner = new google.maps.LatLng(map.getBounds().getNorthEast().lat(), map.getBounds().getNorthEast().lng());

                    // Top right point
                    var topRightPoint = fromLatLngToPoint(topRightCorner).x;

                    // Get pixel position of leftmost and rightmost points
                    var leftCoords = routeBounds.getSouthWest();
                    var leftMost = fromLatLngToPoint(leftCoords).x;
                    var rightMost = fromLatLngToPoint(routeBounds.getNorthEast()).x;

                    // Calculate left and right offsets
                    var leftOffset = (overlayWidth - leftMost);
                    var rightOffset = ((topRightPoint - rightMargin) - rightMost);

                    // Only if left offset is needed
                    if (leftOffset >= 0) {

                        if (leftOffset < rightOffset) {

                            var mapOffset = Math.round((rightOffset - leftOffset) / 2);

                            // Pan the map by the offset calculated on the x axis
                            map.panBy(-mapOffset, 0);

                            // Get the new left point after pan
                            var newLeftPoint = fromLatLngToPoint(leftCoords).x;

                            if (newLeftPoint <= overlayWidth) {

                                // Leftmost point is still under the overlay
                                // Offset map again
                                offsetMap();
                            }

                        } else {

                            // Cannot offset map at this zoom level otherwise both leftmost and rightmost points will not fit
                            // Zoom out and offset map again
                            map.setZoom(map.getZoom() - 1);
                            offsetMap();
                        }
                    }
                }
            }

            // function for from lat lang to point 
            function fromLatLngToPoint(latLng) {

                var scale = Math.pow(2, map.getZoom());
                var nw = new google.maps.LatLng(map.getBounds().getNorthEast().lat(), map.getBounds().getSouthWest().lng());
                var worldCoordinateNW = map.getProjection().fromLatLngToPoint(nw);
                var worldCoordinate = map.getProjection().fromLatLngToPoint(latLng);

                return new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
            }
            });
        }

            var markers = [];

            // make random red, yellow, blue markers
           
            /**************************************************************************/
            /*****************            ADD ALL RANDOM CARS         ****************/
            /**************************************************************************/
            // add random cars to every location which is near to lat long
            // first condition
            for (var i = 0; i < 50; i++) {
                var latLng = new google.maps.LatLng(40.15 - Math.random(),-118.22 - Math.random());
                var marker = new google.maps.Marker({
                position: latLng,
                icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                label: "" + i,
                map: map
                });
                markers.push(marker);
            }
            // second condition
            for (var i = 0; i < 50; i++) {
                var latLng = new google.maps.LatLng(39.22 - Math.random(),-118.21 - Math.random());
                var marker = new google.maps.Marker({
                position: latLng,
                icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                label: "" + i,
                map: map
                });
                markers.push(marker);
            }
            // third condition
            for (var i = 0; i < 50; i++) {
                var latLng = new google.maps.LatLng(37.25 - Math.random(),-118.19 - Math.random());
                var marker = new google.maps.Marker({
                position: latLng,
                icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                label: "" + i,
                map: map
                });
                markers.push(marker);
            }
            // fourth condition
            for (var i = 0; i < 50; i++) {
                var latLng = new google.maps.LatLng(35.17 - Math.random(),-118.15 - Math.random());
                var marker = new google.maps.Marker({
                position: latLng,
                icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                label: "" + i,
                map: map
                });
                markers.push(marker);
            }
            // fifith condition
            for (var i = 0; i < 50; i++) {
                var latLng = new google.maps.LatLng(35.15 - Math.random(),-118.11 - Math.random());
                var marker = new google.maps.Marker({
                position: latLng,
                icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                label: "" + i,
                map: map
                });
                markers.push(marker);
            }

            // sixth condition
            for (var i = 0; i < 50; i++) {
                            var latLng = new google.maps.LatLng(35.11 - Math.random(),-118.71 - Math.random());
                            var marker = new google.maps.Marker({
                            position: latLng,
                            icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                            label: "" + i,
                            map: map
                            });
                            markers.push(marker);
            }
            
            // seventh condition

            for (var i = 0; i < 50; i++) {
                            var latLng = new google.maps.LatLng(35.35 - Math.random(),-118.11 - Math.random());
                            var marker = new google.maps.Marker({
                            position: latLng,
                            icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                            label: "" + i,
                            map: map
                            });
                            markers.push(marker);
            }
            // eighth condition

            for (var i = 0; i < 50; i++) {
                                        var latLng = new google.maps.LatLng(35.67 - Math.random(),-118.7 - Math.random());
                                        var marker = new google.maps.Marker({
                                        position: latLng,
                                        icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                                        label: "" + i,
                                        map: map
                                        });
                                        markers.push(marker);
            }
            // ninth condition

            for (var i = 0; i < 50; i++) {
                                        var latLng = new google.maps.LatLng(35.99 - Math.random(),-118.2 - Math.random());
                                        var marker = new google.maps.Marker({
                                        position: latLng,
                                        icon: 'https://img.icons8.com/color/48/000000/car--v2.png',
                                        label: "" + i,
                                        map: map
                                        });
                                        markers.push(marker);
            }

            // match cluster icon to markers
            var calc = function(markers, numStyles) {
                // default to blue
                var highestPriorityColor = 1;
                for (var i = 0; i < markers.length; i++) {
                if (markers[i].getIcon().indexOf("red.png") > -1) {
                    // if any markers are red, will be red, can return result
                    return {
                    text: markers.length,
                    index: 3
                    }; // index of red
                } else if (markers[i].getIcon().indexOf("yellow.png") > -1) {
                    // if any markers are yellow, update it to yellow if it is blue
                    if (highestPriorityColor < 2)
                    highestPriorityColor = 2; // index of yellow
                }
                /* else if (markers[i].getIcon().indexOf("green.png") > -1) {
                            // ignore green markers (leave it whatever color it is, defaults to blue)
                        } */
                }
                // return result once complete processing all the markers
                return {
                text: markers.length,
                index: highestPriorityColor
                }; // index of chosen cluster
            }

            // define cluster icons
                var mcOptions = {
                    gridSize: 50,
                    maxZoom: 15,
                    styles: [{
                        height: 50,
                        url: "https://raw.githubusercontent.com/googlearchive/js-marker-clusterer/gh-pages/images/m1.png",
                        width: 50
                    },
                    {
                        height: 50,
                        url: "https://raw.githubusercontent.com/googlearchive/js-marker-clusterer/gh-pages/images/m2.png",
                        width: 50
                    },
                    {
                        height: 50,
                        url: "https://raw.githubusercontent.com/googlearchive/js-marker-clusterer/gh-pages/images/m3.png",
                        width: 50
                    }
                    ]
                };
                var start = new google.maps.LatLng(lat1, lng1);
                var end   = new google.maps.LatLng(lat2, lng2);
                
                // calculate route
                calcRoute(start,end);

                //*********DIRECTIONS AND ROUTE**********************//

                source      = start;
                destination = end;
            
                var request = {
                    origin: source,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
            
                //*********DISTANCE AND DURATION**********************//
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [source],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, function (response, status) {
                    if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                        var distance = response.rows[0].elements[0].distance.text;
                        var duration = response.rows[0].elements[0].duration.text;
                        var dvDistance = document.getElementById("dvDistance");
                    dvDistance.innerHTML = "";
                        dvDistance.innerHTML += "Distance: " + distance + "<br />";
                        dvDistance.innerHTML += "Duration:" + duration;
                        // set distance val and duration val 
                        document.getElementById('distance').value = distance;
                        document.getElementById('duration').value = duration;
            
                    } else {
                        alert("Unable to find the distance via road.");
                    }
                });
                var markerCluster = new MarkerClusterer(map, markers, mcOptions);
                markerCluster.setCalculator(calc);
            }

            // call date time picker function
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });

            // submit function
            $(document).ready(function() {
                // ajax pass header
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(".btn-submit").click(function(e){
                    e.preventDefault();
                    // submit variables
                    var fromlocation = $("#autocomplete1").val();
                    var tolocation   = $("#autocomplete2").val();
                    var apptime      = $("input[name='booking_date']").val();
                    var services     = $("#services").val();
                    // distance val
                    var distance     = $("#distance").val();
                    var duration     = $("#duration").val();
                    // user id
                    var userid       = $("#user_id").val();
                    var status       = 'pending';
                    $.ajax({
                        url: "{{ route('firststep.store') }}",
                        type:'POST',
                        data: { from_location:fromlocation, to_location:tolocation,request_time:apptime,services:services,distance:distance,duration:duration,user_id:userid,status:status},
                        success: function(data) {
                        console.log(data.error)
                            if($.isEmptyObject(data.error)){
                                alert(data.success);
                                setTimeout("window.location = 'first-step'",100);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }); 

                function printErrorMsg (msg) {
                    $.each( msg, function( key, value ) {
                    console.log(key);
                    $('.'+key+'_err').text(value);
                    });
                }
            });

            
    </script>
</html>