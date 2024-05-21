<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bids;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $liczba = Announcement::all();
        $liczba = $liczba -> count();
        $announcements = Announcement::with('photos')->get();

        $cars = Announcement::with('photos')->get();
        if ($liczba >= 4) {
            $randomAnnouncements = $cars->random(4);
            $randomCars = $cars->random(4);
        } else {
            $randomAnnouncements = $cars; // Zwróć wszystkie dostępne samochody, jeśli jest ich mniej niż 4
            $randomCars = $cars;
        }

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

        $liczba = Announcement::all();
        $liczba = $liczba -> count();
        $cars = Announcement::with('photos')->get();
        $cars = Announcement::with('photos')->get();
        if ($liczba >= 4) {

            $randomCars = $cars->random(4);
        } else {

            $randomCars = $cars;
        }

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

    return redirect()->route('cars.user')->with('success', 'Ogłoszenie zostało usunięte.');
}

public function edit($id)
{
    $announcement = Announcement::findOrFail($id);
    return view('cars.edit', compact('announcement'));
}

public function update(Request $request, $id)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'name' => 'required|string|max:30',
            'brand' => 'required|string|max:30',
            'year' => 'required|integer|digits:4|min:1976|max:' . date('Y'),
            'mileage' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'min_price' => 'required|numeric|min:100',
        ], [
            'name.required' => 'Pole Marka jest wymagane.',
            'name.string' => 'Pole Marka musi być ciągiem znaków.',
            'name.max' => 'Pole Marka może mieć maksymalnie 30 znaków.',
            'brand.required' => 'Pole Model jest wymagane.',
            'brand.string' => 'Pole Model musi być ciągiem znaków.',
            'brand.max' => 'Pole Model może mieć maksymalnie 30 znaków.',
            'year.required' => 'Pole Rok produkcji jest wymagane.',
            'year.integer' => 'Pole Rok produkcji musi być liczbą całkowitą.',
            'year.digits' => 'Pole Rok produkcji musi mieć 4 cyfry.',
            'year.min' => 'Pole Rok produkcji nie może być wcześniejsze niż 1976.',
            'year.max' => 'Pole Rok produkcji nie może być późniejsze niż bieżący rok.',
            'mileage.required' => 'Pole Przebieg jest wymagane.',
            'mileage.numeric' => 'Pole Przebieg musi być liczbą.',
            'mileage.min' => 'Pole Przebieg nie może być mniejsze niż 0.',
            'description.string' => 'Pole Opis musi być ciągiem znaków.',
            'min_price.required' => 'Pole Cena jest wymagane.',
            'min_price.numeric' => 'Pole Cena musi być liczbą.',
            'min_price.min' => 'Pole Cena nie może być mniejsze niż 100.',
        ]);

        // Znalezienie ogłoszenia i aktualizacja danych
        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        return redirect()->route('cars.index')->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        // Dodaj debugowanie, aby sprawdzić wartości przekazywane do metody
        //dd($request->all());

        //dd($request);

        Announcement::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'end_date' => $request->end_date,
            'min_price' => $request->min_price,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Ogłoszenie zostało dodane.');
    }

}
