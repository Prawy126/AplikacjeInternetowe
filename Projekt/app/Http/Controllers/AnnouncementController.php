<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bids;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $cars = Announcement::with('photos')->get();
        $randomCars = $cars->random(4);

        // Pobierz ostatnio licytowane samochody
        $recentBids = Bids::with('announcement')->orderBy('time', 'desc')->take(5)->get();

        return view('cars.index', [
            'cars' => $cars,
            'randomCars' => $randomCars,
            'recentBids' => $recentBids,
        ]);
    }

    public function show($id)
    {
        $car = Announcement::with('photos')->findOrFail($id);
        return view('cars.show', compact('car'));
    }
}
