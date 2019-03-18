@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="text-align: center; margin: 1rem 0">
            <h2>Upcoming Events</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div style="margin: .5rem">
                    <input id="searchString" class="form-control" style="width: 400px" name="searchString" type="text">
                </div>
                <div style="margin: .5rem">
                    <button class="btn btn-primary" onclick="search()">Search</button>
                </div>
            </div>
            <div id="eventFeed">

                <?php
                
                    if (isset($events)) {
                        if (count($events) > 0) {
                            if (Auth::check()) { // if logged in
                                if (isset($role) && $role == 'administrator') {
                                    foreach ($events as $event) {
                                        echo "<div id=" . $event->id . " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" . $event->title . "</div><div class='card-body'><p class='card-text'>" . $event->location . "</p><p class='card-text'>" . $event->description . "</p><p class='card-text'>" . $event->date . "</p><p class='card-text'>" . $event->time . "</p><a href='/api/events/deleteEvent/".$event->id."'><button>Delete</button></a></div></div></div></div>";
                                    }
                                } else { ?>
                                    @if (isset($going))
                                        @foreach ($events as $event)
                                            
                                            @include('layouts.event', ['event' => $event, 'going' => $going])

                                        @endforeach
                                    @endif
                            <?php }
                            } else {
                                foreach ($events as $event) {
                                    echo "<div id=" . $event->id . " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" . $event->title . "</div><div class='card-body'><p class='card-text'>" . $event->location . "</p><p class='card-text'>" . $event->description . "</p><p class='card-text'>" . $event->date . "</p><p class='card-text'>" . $event->time . "</p></div></div></div></div>";
                                }
                            }
                        } else {
                            echo "<div class='row justify-content-center' style='margin-top: 4rem'><h4>No events to show</h4></div>";
                        }
                        
                    }
                    
                ?>

                <div class="row justify-content-center" style="margin-top: 2rem">
                    {{ $events->links() }}
                </div>
            </div>
            <div id="searchPage" style="display: none">
                <div class='row justify-content-center'>
                    <div class="col-md-8" style="margin-top: 1rem">
                        <button class="btn btn-primary" style="width: 200px" onclick="showAll()">Show All</button>
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
                                event = "<div id=" + result[i].id + " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><a href='/api/events/deleteEvent/" + result[i].id + "'><button>Delete</button></a></div></div></div></div>";
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
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p><p style='color: green'>Going</p></div></div></div></div></a>";
                                } else {
                                    event = "<a href='/event/" + result[i].id + "' style='text-decoration: none; color: black;'><div id=" + result[i].id + " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p></div></div></div></div></a>";
                                }
                                events.push(event);
                            }
                        }
                    } else {
                        for (i = 0; i < result.length; i++) {
                            event = "<div id=" + result[i].id + " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'>" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p></div></div></div></div>";
                            events.push(event);
                        }
                    }
                    
                    
                } else {
                    
                    events.push("<div>No resultsss</div>");
                }
                $('#searchFeed').html(events);
                $('#eventFeed').css("display", "none");
                $('#searchPage').css("display", "inline");
                $('#searchFeed').css("display", "inline");
            }
        });
    };

    let showAll = () => {
        $('#searchPage').css("display", "none");
        $('#searchFeed').css("display", "none");
        $('#eventFeed').css("display", "inline");
    }
    /* old way to grab events
    $(document).ready(function(){
        let data;
        $.ajax({
            data: data,
            type: "get",
            url: "/api/events",
            success: function(result){
                console.log(result);
                let events = [];
                if (result.length > 0) {
                    console.log(result[0].title)
                    let event;
                    for (i = 0; i < result.length; i++) {
                        console.log(result[i].location);
                        event = "<div id=" + result[i].id + " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" + result[i].title + "</div><div class='card-body'><p class='card-text'" + result[i].location + "</p><p class='card-text'>" + result[i].description + "</p><p class='card-text'>" + result[i].date + "</p><p class='card-text'>" + result[i].time + "</p></div></div></div></div>";
                        events.push(event);
                    }
                } else {
                    noEvents = true;
                    events.push("<div>No events yet</div>");
                }
                $('#eventFeed').html(events);
            }
        });
    

    });
    */

</script>
@endsection