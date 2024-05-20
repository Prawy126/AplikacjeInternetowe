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

        // Pobierz ostatnio licytowane ogłoszenia
        $recentBids = Bids::with('announcement')->orderBy('time', 'desc')->take(5)->get();

        return view('cars.index', [
            'announcements' => $announcements,
            'randomAnnouncements' => $randomAnnouncements,
            'recentBids' => $recentBids,
        ]);
    }

    public function show($id)
    {
        $announcement = Announcement::with('photos')->findOrFail($id);
        return view('cars.show', compact('announcement'));
    }

    public function oferty()
    {
        $announcements = Announcement::with('photos')->get();
        $randomAnnouncements = $announcements->random(4);

        // Pobierz ostatnio licytowane ogłoszenia
        $recentBids = Bids::with('announcement')->orderBy('time', 'desc')->take(6)->get();

        return view('cars.oferty', [
            'announcements' => $announcements,
            'randomAnnouncements' => $randomAnnouncements,
            'recentBids' => $recentBids,
        ]);
    }
}
