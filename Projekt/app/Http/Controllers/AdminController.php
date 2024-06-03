<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Bid;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $announcements = Announcement::all();

          // Przykładowe dane do wykresów
    $userCount = User::count();
    $announcementCount = Announcement::count();

    // Dane do wykresu liczby użytkowników i ogłoszeń w ciągu ostatnich 6 miesięcy
    $userStats = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->take(6)
        ->get();

    $announcementStats = Announcement::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->take(6)
        ->get();

    $userAnnouncements = User::withCount('announcements')->get();

        // Dane dotyczące liczby ogłoszeń dla każdego użytkownika
        $userAnnouncements = User::withCount('announcements')->get();

        // Średnia liczba ogłoszeń na użytkownika
        $averageAnnouncementsPerUser = $userAnnouncements->avg('announcements_count');

        // Średnia liczba ofert na dzień (z ostatnich 30 dni)
        $bidsPerDay = Bid::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get();

        $averageOffersPerDay = $bidsPerDay->avg('count');

        return view('admin.dashboard', compact('users', 'announcements', 'userCount', 'announcementCount', 'userStats', 'announcementStats', 'userAnnouncements', 'userAnnouncements', 'averageAnnouncementsPerUser', 'averageOffersPerDay'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'email' => 'required|email|max:40|unique:users,email,' . $id,
            'address' => 'required|string|max:40',
            'phone_number' => 'required|string|max:15',
            'role' => 'required|string|max:20',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Użytkownik został zaktualizowany.');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.edit_announcement', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer|min:1886|max:' . date('Y'),
            'mileage' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'min_price' => 'required|numeric|min:0',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);


        foreach ($user->announcements as $announcement) {
            $announcement->bids()->delete();
            $announcement->photos()->delete();
        }


        $user->announcements()->delete();

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Użytkownik został usunięty.');
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);


        $announcement->photos()->delete();


        $announcement->bids()->delete();


        $announcement->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Ogłoszenie zostało usunięte.');
    }
}
