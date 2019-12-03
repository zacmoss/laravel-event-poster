@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create An Event</div>

                <div class="card-body">
                    <form method="POST" action="/api/events/createEvent">
                        @csrf

                        <div class="form-group row">
                            <label for="event_title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="event_title" type="text" class="form-control" name="event_title" autocomplete="off" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_title" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <select id="event_city" class="form-control" name="event_city" required>
                                    <option value="Lafayette">Lafayette</option>
                                    <option value="New York">New York</option>
                                    <option value="Chicago">Chicago</option>
                                    <option value="Los Angeles">Los Angeles</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_location" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                                <input id="event_location" type="text" class="form-control" name="event_location" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="event_description" type="text" class="form-control" name="event_description" autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_date" class="col-md-4 col-form-label text-md-right">Date</label>

                            <div class="col-md-6">
                                <input id="event_date" type="date" class="form-control" name="event_date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_time" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <select id="event_time" class="form-control" name="event_time">
                                    <option value="1:00am">1:00am</option>
                                    <option value="2:00am">2:00am</option>
                                    <option value="3:00am">3:00am</option>
                                    <option value="4:00am">4:00am</option>
                                    <option value="5:00am">5:00am</option>
                                    <option value="6:00am">6:00am</option>
                                    <option value="7:00am">7:00am</option>
                                    <option value="8:00am">8:00am</option>
                                    <option value="9:00am">9:00am</option>
                                    <option value="10:00am">10:00am</option>
                                    <option value="11:00am">11:00am</option>
                                    <option value="12:00pm">12:00pm</option>
                                    <option value="1:00pm">1:00pm</option>
                                    <option value="2:00pm">2:00pm</option>
                                    <option value="3:00pm">3:00pm</option>
                                    <option value="4:00pm">4:00pm</option>
                                    <option value="5:00pm">5:00pm</option>
                                    <option value="6:00pm">6:00pm</option>
                                    <option value="7:00pm">7:00pm</option>
                                    <option value="8:00pm">8:00pm</option>
                                    <option value="9:00pm">9:00pm</option>
                                    <option value="10:00pm">10:00pm</option>
                                    <option value="11:00pm">11:00pm</option>
                                    <option value="12:00am">12:00am</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="width: 100%">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // grabs today and passes it as the min for date
    let today = new Date();
    console.log(today);
    let dd = today.getDate();
    dd = parseInt(dd);
    let mm = today.getMonth() + 1;

    if (mm < 10) {
        mm = "0" + parseInt(mm);
    } else {
        mm = parseInt(mm);
    }

    let yyyy = today.getFullYear();
    yyyy = parseInt(yyyy);
    document.getElementById("event_date").min = yyyy + '-' + mm + '-' + dd;
    
</script>

@endsection