@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="text-align: center; margin: 1rem 0">
            <h2>Upcoming Events</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="eventFeed">
            </div>
        </div>
    </div>
</div>

<script>
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

</script>
@endsection