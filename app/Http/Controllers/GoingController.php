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
        $going = new Going;
        $going->userId = Auth::user()->id;
        $going->eventId = request('eventId');
        $going->save();
        return redirect('/eventFeed'); 
    }
    public function delete(Request $request)
    {
        $going = Going::where('eventId', request('eventId'));
        $going->delete();
        return redirect('/eventFeed');
    }
    public function toggle(Request $request)
    {
        if (request('goingBoo') == 'true') {
            $check = Going::where('eventId', request('eventId'))->where('userId', Auth::user()->id)->first();
            if (!$check) {
                $going = new Going;
                $going->userId = Auth::user()->id;
                $going->eventId = request('eventId');
                $going->save();
            }
        } else {
            $going = Going::where('eventId', request('eventId'))->where('userId', Auth::user()->id);
            $going->delete();
        }
        return redirect('/eventFeed');
    }
}
