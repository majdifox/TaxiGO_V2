<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class driverController extends Controller
{
    public function index(){

        return view('driver.awaitingRides');

    }
}
