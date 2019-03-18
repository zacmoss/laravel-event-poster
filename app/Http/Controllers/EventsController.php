<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Going;
use Auth;

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
    public function feed()
    {
        /*
        $events = Event::get()->all();
        $eventsRender = "";
        if (count($events) > 0) {
            
            foreach ($events as $event) {
                
                $div = "<div id=" . $event->id . " class='row justify-content-center event-card'><div class='col-md-8'><div class='card'><div class='card-header'>" . $event->title . "</div><div class='card-body'><p class='card-text'>" . $event->location . "</p><p class='card-text'>" . $event->description . "</p><p class='card-text'>" . $event->date . "</p><p class='card-text'>" . $event->time . "</p></div></div></div></div>";
                $eventsRender .= $div;
            }
            
        } else {
            $eventsRender = "<div>No events yet</div>";
        }
        return view('eventFeed', compact('eventsRender'));
        */
        $events = DB::table('events')->paginate(2);
        if (Auth::check()) {
            $role = Auth::user()->role;
            //$going = Auth::user()->going;
            $going = Going::get()->all();
        } else {
            $role = 'client';
            $going = [];
        }
        return view('eventFeed', ['events' => $events, 'role' => $role, 'going' => $going]);
    }
    public function search(Request $request)
    {
        $searchString = request('searchString');
        $results = Event::where('title', 'like', "%{$searchString}%")->orWhere('location', 'like', "%{$searchString}%")->orWhere('description', 'like', "%{$searchString}%")->get();
        $going = Going::get()->all();
        $id = Auth::user()->id;
        return (['results' => $results, 'going' => $going, 'id' => $id]);
    }
    public function delete(Request $request) {
        $event = Event::where('id', request('id'));
        $event->delete();
        //return response()->json(['return' => 'event deleted']);
        session()->flash('message', 'Event deleted!');
        return redirect('/eventFeed');
    }
    public function singleEvent(Request $request) {
        //$event = Event::where('id', request('id'));
        $events = Event::get()->all();
        $going = Going::get()->all();
        return view('eventPage', ['events' => $events, 'going' => $going, 'id' => request('id')]);
    }
    public function myEvents(Request $request) {
        $events = Event::get()->all();
        $going = Going::get()->all();
        return view('myEvents', ['events' => $events, 'going' => $going]);
    }
}
