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

        // Średnia cena ofert
        $averageBidPrice = Bid::avg('amount');

        return view('admin.dashboard', [
            'users' => $users,
            'announcements' => $announcements,
            'userCount' => $userCount,
            'announcementCount' => $announcementCount,
            'userStats' => $userStats,
            'announcementStats' => $announcementStats,
            'userAnnouncements' => $userAnnouncements,
            'averageAnnouncementsPerUser' => $averageAnnouncementsPerUser,
            'averageOffersPerDay' => $averageOffersPerDay,
            'averageBidPrice' => $averageBidPrice
        ]);

    }
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'email' => 'required|email|max:40|unique:users,email,' . $id,
            'address' => 'required|string|max:40',
            'phone_number' => 'required|string|max:9',
            'role' => 'required|string|max:20',
        ], [
            'name.required' => 'Pole imię jest wymagane.',
            'name.string' => 'Pole imię musi być ciągiem znaków.',
            'name.max' => 'Pole imię nie może przekraczać 30 znaków.',
            'surname.required' => 'Pole nazwisko jest wymagane.',
            'surname.string' => 'Pole nazwisko musi być ciągiem znaków.',
            'surname.max' => 'Pole nazwikso nie może przekraczać 30 znaków.',
            'email.required' => 'Pole email jest wymagane.',
            'email.email' => 'Pole email musi być prawidłwoym adresem email.',
            'email.max' => 'Pole email nie może przekraczać 40 znaków.',
            'email.unique' => 'Podany email jest już zajęty.',
            'address.required' => 'Pole adres jest wymagane.',
            'address.string' => 'Pole adres musi być ciągiem znaków.',
            'address.max' => 'Pole adres nie może przekraczać 40 znaków.',
            'phone_number.required' => 'Pole numer telefonu jest wymagane.',
            'phone_number.string' => 'Pole numer telefonu musi być ciągiem znaków.',
            'phone_number.max' => 'Pole numer telefonu nie może przekraczać 9 znaków.',
            'role.required' => 'Pole rola jest wymagane.',
            'role.string' => 'Pole rola musi być ciągiem znaków.',
            'role.max' => 'Pole rola nie może przekraczać 20 znaków.',
        ]);


        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Użytkownik został zaktualizowany.');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.edit_announcement', ['announcement' => $announcement]);
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
        ], [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.string' => 'Pole nazwa musi być ciągiem znaków.',
            'name.max' => 'Pole nazwa nie może przekraczać 255 znaków.',
            'brand.required' => 'Pole marka jest wymagane.',
            'brand.string' => 'Pole marka musi być ciągiem znaków.',
            'brand.max' => 'Pole marka nie może przekraczać 255 znaków.',
            'year.required' => 'Pole rok proudkcji jest wymagane.',
            'year.integer' => 'Pole rok produkcji musi być liczbą całkowitą.',
            'year.min' => 'Pole rok produkcji nie może być wcześniejsze niż 1886.',
            'year.max' => 'Pole rok produkcji nie może być późniejsze niż bieżący rok.',
            'mileage.required' => 'Pole przebieg jest wymagane.',
            'mileage.numeric' => 'Pole przebieg musi być liczbą.',
            'mileage.min' => 'Pole przebieg nie może być mniejsze niż 0.',
            'description.string' => 'Pole opis musi być ciągiem znaków.',
            'min_price.required' => 'Pole cena minimalna jest wymagane.',
            'min_price.numeric' => 'Pole cena minimalna musi być liczbą.',
            'min_price.min' => 'Pole cena minimalna nie może być mniejsze niż 0.',
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
