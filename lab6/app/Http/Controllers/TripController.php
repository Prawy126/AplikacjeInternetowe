<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.show', compact('trip'));
    }
}
