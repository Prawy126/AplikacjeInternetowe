<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Country;

class TripController extends Controller
{
    public function index(){
        return view('trips.index', [
            'trips' => Trip::all(),
            'cheap_trips' => Trip::orderBy('price')->take(4)->get(),
            'randomTrips' => Trip::inRandomOrder()->limit(4)->get() // Ensure this line is correct
        ]);
    }
    

    public function show($id)
    {
        return view('trips.show', [
            't' => Trip::findOrFail($id)
        ]);
    }

    public function edit(Trip $trip)
    {
        $countries = Country::all(); // Get all countries for the dropdown
        return view('trips.edit', compact('trip', 'countries'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:trips,name,'.$id,
            // inne reguły walidacji...
        ]);
    
        // Pobranie istniejącego obiektu wycieczki z bazy danych
        $trip = Trip::findOrFail($id);
    
        // Zaktualizowanie atrybutów wycieczki na podstawie danych z zapytania
        $trip->update($request->all());
    
        // Przekierowanie użytkownika do listy wycieczek po zaktualizowaniu
        return redirect()->route('trips.index');
    }
    
    

    public function showTrips()
    {
        $randomTrips = Trip::inRandomOrder()->take(4)->get();
        return view('trips.index', compact('randomTrips'));
    }

}
