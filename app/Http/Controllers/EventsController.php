<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function index()
    {
        $result = Event::get()->all();
        return $result;
    }
    public function create()
    {
        $this->validate(request(), [
            'event_title' => 'required|max:60',
            'event_location' => 'required|max:60',
            'event_description' => 'required|max:200',
            'event_date' => 'required',
            'event_time' => 'required'
        ]);
        
        $event = new Event;

        $event->title = request('event_title');
        $event->location = request('event_location');
        $event->description = request('event_description');
        $event->date = request('event_date');
        $event->time = request('event_time');

        $event->save();

        //session()->flash('message', 'Person added!');

        return response()->json(['return' => 'event added']); 
    }
}
