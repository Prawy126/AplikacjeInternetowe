<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bids;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('photos')->get();
        $randomAnnouncements = $announcements->random(4);
        $cars = Announcement::with('photos')->get();
        $randomCars = $cars->random(4);
        $recentBids = Bids::with('announcement')->orderBy('time', 'desc')->take(5)->get();

        return view('cars.index', [
            'announcements' => $announcements,
            'randomAnnouncements' => $randomAnnouncements,
            'recentBids' => $recentBids,
            'randomCars' => $randomCars,
        ]);
    }

    public function show($id)
    {
        $car = Announcement::with('photos')->findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function oferty(){
        $cars = Announcement::with('photos')->get();
        $randomCars = $cars->random(4);

        // Pobierz ostatnio licytowane samochody
        $recentBids = Bids::with('announcement')->orderBy('time', 'desc')->take(6)->get();

        return view('cars.oferty', [
            'cars' => $cars,
            'randomCars' => $randomCars,
            'recentBids' => $recentBids,
        ]);
    }

    public function destroy($id)
{
    $announcement = Announcement::findOrFail($id);
    // Usunięcie powiązanych rekordów z tabeli `bids`
    $announcement->histories()->delete();
    // Usunięcie powiązanych rekordów z tabeli `photos`
    $announcement->photos()->delete();
    // Usunięcie ogłoszenia
    $announcement->delete();

    return redirect()->route('cars.index')->with('success', 'Ogłoszenie zostało usunięte.');
}

public function edit($id)
{
    $announcement = Announcement::findOrFail($id);
    return view('cars.edit', compact('announcement'));
}

public function update(Request $request, $id)
{


    $announcement = Announcement::findOrFail($id);
    $announcement->update($request->all());

    return redirect()->route('cars.index')->with('success', 'Ogłoszenie zostało zaktualizowane.');
}
}
