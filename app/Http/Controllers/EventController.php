<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function get(Request $request)
    {
        $user_id = $request->input("user_id");
        $response = Event::get($user_id);
        return response()->json($response);
    }

    //
    public function add(Request $request)
    {
        $event = $request->input("event");
        $user_id = $request->input("user_id");
        $response = Event::add($event, $user_id);
        return response()->json($response);
    }

    //
    public function edit(Request $request)
    {
        $event = $request->input("event");
        $user_id = $request->input("user_id");
        $response = Event::edit($event, $user_id);
        return response()->json($response);
    }

    //
    public function delete(Request $request)
    {
        $event = $request->input("event");
        $user_id = $request->input("user_id");
        $response = Event::remove($event, $user_id);
        return response()->json($response);
    }
}
