@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8" style="text-align: left; margin: 1rem 0">
            <h2>Upcoming Events</h2>
        </div>
    </div>

    <div class="row justify-content-left">
        <div class="col-lg-8">
            <div class="row justify-content-left">
                <div style="margin: .5rem">
                    <input id="searchString" class="form-control" style="width: 400px; margin-left: .5rem" name="searchString" type="text">
                </div>
                <div style="margin: .5rem">
                    <button class="btn btn-primary" onclick="search()">Search</button>
                    <button id="showAllBtn" class="btn btn-primary" style="width: 100px; display: none" onclick="showAll()">Show All</button>
                </div>
            </div>
            <div id="eventFeed">
                @if (isset($events))
                    @if (count($events) > 0)
                        @foreach ($events as $event)
                            @include('layouts.event', ['event' => $event, 'going' => $going])
                        @endforeach
                    @else
                        <?= "<div class='row justify-content-left' style='margin-top: 4rem'><h4>No events to show</h4></div>" ?>
                    @endif
                @endif
                <div class='col-lg-10'>
                <div class="row justify-content-center" style="margin-top: 2rem">
                    {{ $events->links() }}
                </div>
                </div>
            </div>
            <div id="searchPage" style="display: none">
                <div class='row justify-content-left'>
                    <div class="col-md-8" style="margin-top: 1rem">
                        <!--<button class="btn btn-primary" style="width: 200px" onclick="showAll()">Show All</button>-->
                    </div>
                </div>
                <div id="searchFeed" style="displa: none"></div>
                <div class='row justify-content-center' style='margin-top: 2rem'>
                    <?php if (isset($results)) : ?>
                    {{ $results->links() }}
                    <?php endif ?>
                </div>
            </div>
            
        </div>

        <div id="filters" class="col-lg-4">
            <div class="row justify-content-center">
                <div>
                    <h5 style="margin-bottom: 2rem">Filters</h5>
                
                    <label>Filter by date</label>
                    <input class="form-control" style="width: 100% !important" id="filterDate" type='date'>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary" style="width: 85%; margin-top:2rem" onclick="filter()">Filter</button>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>

<script>
    
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
                //let result = response.data;
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
                            event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div>";
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
        });
    };

    let filter = () => {
        let date = $("#filterDate").val();
        $.ajax({
            data: date,
            type: "get",
            url: "/api/events/eventFilter/date/" + date,
            success: function(response){
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
                            event = "<div id=" + result[i].id + " class='row justify-content-left event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>Location: " + result[i].location + "</p><p class='card-text'>Description: " + result[i].description + "</p><p class='card-text'>Date: " + result[i].date + "</p><p class='card-text'>Time: " + result[i].time + "</p></div></div></div></div>";
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
            }
        });
    }

    let showAll = () => {
        $('#searchPage').css("display", "none");
        $('#searchFeed').css("display", "none");
        $('#showAllBtn').css("display", "none");
        $('#eventFeed').css("display", "inline");
    }

</script>
@endsection