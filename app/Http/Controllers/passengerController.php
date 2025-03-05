<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class passengerController extends Controller
{
    public function index(){

        return view('passenger.upcomingRides');

    }

    public function activeride(){

        return view('passenger.activeRide');

    }

    public function test(){

        return view('passenger.activeRide');

    }
}
