@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="row justify-content-left">
                <div class="col-lg-12" style="text-align: left; margin: 1rem 0">
                    <h2>Upcoming Events</h2>
                </div>
            </div>
<!-- width: 400px; -->
            <div class="row justify-content-left">
                <div class="col-lg-11">
                    <div class="row justify-content-left" style="margin-bottom: 2rem">
                        <div style="margin: .5rem">
                            <input id="searchString" class="form-control" style="width: 400px; margin-left: .5rem" name="searchString" type="text">
                        </div>
                        <div style="margin: .5rem">
                            <button class="btn btn-primary" onclick="search()">Search</button>
                            <button id="showAllBtn" class="btn btn-primary" style="width: 100px; display: none" onclick="showAll()">Show All</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-left">
                <div class="col-lg-12">
                    <!--<p style="margin-top: .5rem"><i>Showing events for Lafayette</i></p>-->
                    <div id="eventFeed">
                        @if (isset($events))
                            @if (count($events) > 0)
                                @foreach ($events as $event)
                                    @include('layouts.event', ['event' => $event, 'going' => $going])
                                @endforeach
                            @else
                                <?= "<div class='row justify-content-center' style='margin-top: 6rem'><h4>No events to show</h4></div>" ?>
                            @endif
                        @endif
                        <div class='col-lg-10'>
                        <div class="row justify-content-center" style="margin-top: 2rem">
                            {{ $events->links() }}
                        </div>
                        </div>
                    </div>
                    <div id="searchPage" style="display: none">
                        <div id="searchFeed" style="displa: none"></div>
                        <div class='row justify-content-center' style='margin-top: 2rem'>
                            <?php if (isset($results)) : ?>
                            {{ $results->links() }}
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div id="filters" class="col-lg-12" style="padding-top: 6rem">
                <div class="row justify-content-center">
                    <div>
                        <div>
                            <h5 style="margin-bottom: 2rem">Filters</h5>
                            <label>Filter by date</label>
                            <input class="form-control" style="width: 100% !important" id="filterDate" type='date'>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary" style="width: 85%; margin-top:1rem" onclick="filter()">Filter by date</button>
                            </div>
                        </div>

                        <div style="margin-top: 4rem">
                            <label>Filter by city</label>
                            <select class="form-control" style="width: 100% !important" id="filterCity">
                                <option value="Lafayette">Lafayette</option>
                                <option value="New York">New York</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Los Angeles">Los Angeles</option>
                            </select>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary" style="width: 85%; margin-top:1rem" onclick="filterByCity()">Filter by city</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /*
    // check for location
    // if location and if lafayette filter lafayette events
    // else if other location filter to other location
    // else if no location default to lafayette events

    // geolocation code on document ready
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            //alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        console.log(position);
        console.log(position.coords.latitude);
        console.log(position.coords.longitude);
        locator(position.coords.latitude, position.coords.longitude);
    }

    // can add piece where we check if user within five units of lat and lon
    // would do something like 30 and 92 - 1 & + 1 if lower is < lat/lon and higher is > than lat/lon they're near lafayette 
    // maybe diff should be .5 or .75 and not 1 to work for baton rouge
    function locator(lat, lon) {
        if (Math.floor(lat) === 30 && Math.floor(Math.abs(lon)) === 92) { // Lafayette
            //alert("you're in lafayette");
            // filter lafayette events
        } else {
            //alert("not in lafayette");
            // check for other location
            // or default to lafayette events
        }
    }

    $(document).ready(function() {
        getLocation();
    });
    */





    let role = "<?php if (isset($role)) {
        echo $role;
    } else {
        echo 'no';
    }
    ?>";
    let loggedIn = "<?php if(Auth::check()) {
        echo true;
    } else {
        echo false;
    }?>"
        
    let search = () => {
        let searchString = $("#searchString").val();
        $.ajax({
            data: searchString,
            type: "get",
            url: "/api/events/eventSearch/" + searchString,
            success: function(response){
                ajaxEventsRender(response);
                /*
                //let result = response.data;
                let result = response.results;
                let going = response.going;                    
                let events = [];
                if (result.length > 0) {
                    let event;
                    if (loggedIn) {
                        if (role === 'administrator') {
                            for (i = 0; i < result.length; i++) {
                                event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><a href='/api/events/deleteEvent/" + result[i].id + "'><button>Delete</button></a></div></a></div></div></div>";
                                events.push(event);
                            }
                        } else {
                            for (i = 0; i < result.length; i++) {
                                let boo = false;
                                for (j = 0; j < going.length; j++) {
                                    if (going[j].eventId === result[i].id && going[j].userId === response.id) {
                                        boo = true;
                                    }
                                }
                                if (boo) {
                                    event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p><p style='color: green'><i>Currently going to this event</i></p></div></a></div></div></div>";
                                } else {
                                    event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></a></div></div></div>";
                                }
                                events.push(event);
                            }
                        }
                    } else {
                        for (i = 0; i < result.length; i++) {
                            event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></a></div></div></div>";
                            events.push(event);
                        }
                    }
                    
                    
                } else {
                    
                    events.push("<div class='row justify-content-center' style='margin-top: 6rem'><h2>No results</h2></div>");
                }
                $('#searchFeed').html(events);
                $('#eventFeed').css("display", "none");
                $('#searchPage').css("display", "inline");
                $('#searchFeed').css("display", "inline");
                $('#showAllBtn').css("display", "inline");
                */
            }
        });
    };

    let filter = () => {
        let date = $("#filterDate").val();
        $.ajax({
            data: date,
            type: "get",
            url: "/api/events/eventFilter/date/" + date,
            success: function(response){
                ajaxEventsRender(response);
                /*
                let result = response.results;
                let going = response.going;                    
                let events = [];
                if (result.length > 0) {
                    let event;
                    if (loggedIn) {
                        if (role === 'administrator') {
                            for (i = 0; i < result.length; i++) {
                                event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><a href='/api/events/deleteEvent/" + result[i].id + "'><button>Delete</button></a></div></div></div></div>";
                                events.push(event);
                            }
                        } else {
                            for (i = 0; i < result.length; i++) {
                                let boo = false;
                                for (j = 0; j < going.length; j++) {
                                    if (going[j].eventId === result[i].id && going[j].userId === response.id) {
                                        boo = true;
                                    }
                                }
                                if (boo) {
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p><p style='color: green'><i>Currently going to this event</i></p></div></div></div></div></a>";
                                } else {
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div></a>";
                                }
                                events.push(event);
                            }
                        }
                    } else {
                        for (i = 0; i < result.length; i++) {
                            event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div></a>";
                            events.push(event);
                        }
                    }
                    
                    
                } else {
                    
                    events.push("<div class='row justify-content-center' style='margin-top: 6rem'><h2>No results</h2></div>");
                }
                $('#searchFeed').html(events);
                $('#eventFeed').css("display", "none");
                $('#searchPage').css("display", "inline");
                $('#searchFeed').css("display", "inline");
                $('#showAllBtn').css("display", "inline");
                */
            }
        });
    }


    let filterByCity = () => {
        let city = $("#filterCity").val();
        $.ajax({
            data: city,
            type: "get",
            url: "/api/events/eventFilter/city/" + city,
            success: function(response){
                ajaxEventsRender(response);
                /*
                let result = response.results;
                let going = response.going;                    
                let events = [];
                if (result.length > 0) {
                    let event;
                    if (loggedIn) {
                        if (role === 'administrator') {
                            for (i = 0; i < result.length; i++) {
                                event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><a href='/api/events/deleteEvent/" + result[i].id + "'><button>Delete</button></a></div></div></div></div></a>";
                                events.push(event);
                            }
                        } else {
                            for (i = 0; i < result.length; i++) {
                                let boo = false;
                                for (j = 0; j < going.length; j++) {
                                    if (going[j].eventId === result[i].id && going[j].userId === response.id) {
                                        boo = true;
                                    }
                                }
                                if (boo) {
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p><p style='color: green'><i>Currently going to this event</i></p></div></div></div></div></a>";
                                } else {
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div></a>";
                                }
                                events.push(event);
                            }
                        }
                    } else {
                        for (i = 0; i < result.length; i++) {
                            event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div></a>";
                            events.push(event);
                        }
                    }
                    
                    
                } else {
                    
                    events.push("<div class='row justify-content-center' style='margin-top: 6rem'><h2>No results</h2></div>");
                }
                $('#searchFeed').html(events);
                $('#eventFeed').css("display", "none");
                $('#searchPage').css("display", "inline");
                $('#searchFeed').css("display", "inline");
                $('#showAllBtn').css("display", "inline");
                */
            }
        });
    }




    let showAll = () => {
        $('#searchPage').css("display", "none");
        $('#searchFeed').css("display", "none");
        $('#showAllBtn').css("display", "none");
        $('#eventFeed').css("display", "inline");
    }


    let ajaxEventsRender = (response) => {
        let result = response.results;
        let going = response.going;                    
        let events = [];
        if (result.length > 0) {
            let event;
            if (loggedIn) {
                if (role === 'administrator') {
                    for (i = 0; i < result.length; i++) {
                        event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><a href='/api/events/deleteEvent/" + result[i].id + "'><button>Delete</button></a></div></a></div></div></div>";
                        events.push(event);
                    }
                } else {
                    for (i = 0; i < result.length; i++) {
                        let boo = false;
                        for (j = 0; j < going.length; j++) {
                            if (going[j].eventId === result[i].id && going[j].userId === response.id) {
                                boo = true;
                            }
                        }
                        if (boo) {
                            event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p><p style='color: green'><i>Currently going to this event</i></p></div></a></div></div></div>";
                        } else {
                            event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></a></div></div></div>";
                        }
                        events.push(event);
                    }
                }
            } else {
                for (i = 0; i < result.length; i++) {
                    event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-lg-10'><div class='card'><a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></a></div></div></div>";
                    events.push(event);
                }
            }
            
            
        } else {
            
            events.push("<div class='row justify-content-center' style='margin-top: 6rem'><h2>No results</h2></div>");
        }
        $('#searchFeed').html(events);
        $('#eventFeed').css("display", "none");
        $('#searchPage').css("display", "inline");
        $('#searchFeed').css("display", "inline");
        $('#showAllBtn').css("display", "inline");
    }

</script>
@endsection