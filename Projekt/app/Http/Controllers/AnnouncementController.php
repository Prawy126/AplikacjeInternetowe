<?php
namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bid;
use App\Models\Photo;
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
        $number = Announcement::all()->count();
        $cars = Announcement::with('photos')->get();

        if ($number >= 4) {
            $randomCars = $cars->random(4);
        } else {
            $randomCars = $cars;
        }

        $recentBids = Bid::with('announcement')->orderBy('time', 'desc')->take(6)->get();

        return view('cars.oferty', [
            'cars' => $cars,
            'randomCars' => $randomCars,
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
            return redirect()->route('cars.index')->with('error', 'Nie można edytować zakończonej aukcji.');
        }

        return view('cars.edit', ['announcement' => $announcement]);
    }

    public function update(Request $request, $id)
    {
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

        $announcement = Announcement::findOrFail($id);

        if ($announcement->is_end || $announcement->end_date < now()) {
            return redirect()->route('cars.index')->with('error', 'Nie można zaktualizować zakończonej aukcji.');
        }

        $announcement->update($request->all());

        return redirect()->route('cars.index')->with('success', 'Ogłoszenie zostało zaktualizowane.');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $photo = new Photo([
                'announcement_id' => $announcement->id,
                'photo_name' => $imagePath,
            ]);
            $photo->save();
        }

        return redirect()->route('announcements.index')->with('success', 'Ogłoszenie zostało dodane.');
    }
}

