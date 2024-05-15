<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //🧟🧟

    public function index()
    {
        $cars = Announcement::all();
        return view('cars.index', [
            'cars' => $cars,
            'randomCars' => $cars->random(2),
        ]);
    }

    public function show($id)
    {
        $car = Announcement::findOrFail($id);
        return view('cars.show', compact('car'));
    }

}
