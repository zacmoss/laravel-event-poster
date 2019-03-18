<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Going;
use Auth;

class GoingController extends Controller
{
    public function index()
    {
        $result = Going::get()->all();
        return $result;
    }
    public function create()
    {
        /*
        $this->validate(request(), [
            'event_title' => 'required|max:60',
            'event_location' => 'required|max:60',
            'event_description' => 'required|max:200',
            'event_date' => 'required',
            'event_time' => 'required'
        ]);
        */

        // if this going match doesn't already exist
        
        $going = new Going;

        $going->userId = Auth::user()->id;
        $going->eventId = request('eventId');
        

        $going->save();

        return redirect('/eventFeed'); 
    }
    public function delete(Request $request) {
        $going = Going::where('eventId', request('eventId'));
        $going->delete();
        return redirect('/eventFeed');
    }
}
