<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bid;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    public function index()
    {
        $number = Announcement::count();
        $announcements = Announcement::with('photos')->get();

        if ($number >= 4) {
            $randomAnnouncements = $announcements->random(4);
            $randomCars = $randomAnnouncements;
        } else {
            $randomAnnouncements = $announcements;
            $randomCars = $announcements;
        }

        $recentBids = Bid::with('announcement')->orderBy('time', 'desc')->take(5)->get();

        $participatingAuctions = Announcement::whereHas('bids', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['bids' => function ($query) {
            $query->where('user_id', Auth::id())->latest();
        }])->get();

        return view('cars.index', [
            'announcements' => $announcements,
            'randomAnnouncements' => $randomAnnouncements,
            'recentBids' => $recentBids,
            'randomCars' => $randomCars,
            'participatingAuctions' => $participatingAuctions,
        ]);
    }

    public function show($id)
    {
        $announcement = Announcement::with(['bids' => function($query) {
            $query->orderBy('amount', 'desc')->with('user');
        }, 'photos'])->findOrFail($id);

        $currentDateTime = now();

        if ($announcement->end_date < $currentDateTime) {
            $announcement->is_end = true;
            $announcement->save();
        }

        $highestBid = $announcement->bids->first();

        return view('cars.show', [
            'car' => $announcement,
            'highestBid' => $highestBid,
            'announcement' => $announcement
        ]);
    }

    public function oferty()
    {
        $cars = Announcement::with('photos')->get();

        $recentBids = Bid::with('announcement')->orderBy('time', 'desc')->take(6)->get();

        return view('cars.oferty', [
            'cars' => $cars,

            'recentBids' => $recentBids,
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->photos()->delete();
        $announcement->delete();

        return redirect()->route('cars.user', ['id' => auth()->user()->id])->with('success', 'Ogłoszenie zostało usunięte.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->is_end || $announcement->end_date < now()) {
            return redirect()->route('cars.show', $announcement->id)->with('error', 'Nie można edytować zakończonej aukcji.');
        }

        $date = date('Y-m-d\TH:i', strtotime($announcement->end_date));

        $announcement->end_date = Carbon::parse($announcement->end_date);

        return view('cars.edit', ['announcement' => $announcement, 'date' => $date]);
    }

    public function update(Request $request, $id)
    {
        dd($request);
        $request->validate([
            'name' => 'required|string|max:30',
            'brand' => 'required|string|max:30',
            'year' => 'required|integer|digits:4|min:1976|max:' . date('Y'),
            'mileage' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'min_price' => 'required|numeric|min:100',
            'end_date' => 'required|date|after:now',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'end_date.required' => 'Pole Data końcowa jest wymagane.',
            'end_date.date' => 'Pole Data końcowa musi być prawidłową datą.',
            'end_date.after' => 'Pole Data końcowa musi być datą po obecnej.',
            'images.*.image' => 'Każdy plik musi być obrazem.',
            'images.*.mimes' => 'Każdy plik musi być typu: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Każdy plik nie może być większy niż 2048 KB.',
        ]);

        $announcement = Announcement::findOrFail($id);

        if ($announcement->is_end || $announcement->end_date < now()) {
            return redirect()->route('cars.show', $announcement->id)->with('error', 'Nie można zaktualizować zakończonej aukcji.');
        }

        $announcement->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('img', 'public');
                $photo = new Photo([
                    'announcement_id' => $announcement->id,
                    'photo_name' => $imagePath,
                ]);
                $photo->save();
            }
        }


        return redirect()->route('cars.show', $announcement->id)->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }
    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'mileage' => 'required|integer',
            'description' => 'nullable|string',
            'end_date' => 'required|date',
            'min_price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $announcement = Announcement::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'end_date' => $request->end_date,
            'is_end' => false,
            'min_price' => $request->min_price,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('img', 'public');
                $photo = new Photo([
                    'announcement_id' => $announcement->id,
                    'photo_name' => $imagePath,
                ]);
                $photo->save();
            }
        }

        return redirect()->route('announcements.index')->with('success', 'Ogłoszenie zostało dodane.');
    }
}
