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
                            <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>

                            <div class="col-md-6">
                                <input id="event_date" type="date" class="form-control" name="event_date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <select id="event_time" class="form-control" name="event_time">
                                    <option value="1:00">1:00am</option>
                                    <option value="2:00">2:00am</option>
                                    <option value="3:00">3:00am</option>
                                    <option value="4:00">4:00am</option>
                                    <option value="5:00">5:00am</option>
                                    <option value="6:00">6:00am</option>
                                    <option value="7:00">7:00am</option>
                                    <option value="8:00">8:00am</option>
                                    <option value="9:00">9:00am</option>
                                    <option value="10:00">10:00am</option>
                                    <option value="11:00">11:00am</option>
                                    <option value="12:00">12:00pm</option>
                                    <option value="13:00">1:00pm</option>
                                    <option value="14:00">2:00pm</option>
                                    <option value="15:00">3:00pm</option>
                                    <option value="16:00">4:00pm</option>
                                    <option value="17:00">5:00pm</option>
                                    <option value="18:00">6:00pm</option>
                                    <option value="19:00">7:00pm</option>
                                    <option value="20:00">8:00pm</option>
                                    <option value="21:00">9:00pm</option>
                                    <option value="22:00">10:00pm</option>
                                    <option value="23:00">11:00pm</option>
                                    <option value="24:00">12:00am</option>
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
@endsection