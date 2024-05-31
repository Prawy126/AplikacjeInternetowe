<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Photo;
use Illuminate\Http\Request;

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
}
