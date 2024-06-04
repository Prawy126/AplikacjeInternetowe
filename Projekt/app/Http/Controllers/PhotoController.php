<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('cars.index', [
            'photos' => $photos,
            'randomPhoto' => $photos->random(2),
        ]);
    }

    public function show($id)
    {
        $car = Announcement::with('photos')->findOrFail($id);
        return view('cars.show', ['car' => $car]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        Storage::disk('public')->delete($photo->photo_name);
        $photo->delete();

        return back()->with('success', 'Zdjęcie zostało usunięte.');
    }
}
