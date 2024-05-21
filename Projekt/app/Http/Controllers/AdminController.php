<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $announcements = Announcement::all();

        return view('admin.dashboard', compact('users', 'announcements'));
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

        // Usuń powiązane rekordy w tabeli bids dla każdego ogłoszenia
        foreach ($user->announcements as $announcement) {
            $announcement->bids()->delete();
            $announcement->photos()->delete();
        }

        // Usuń powiązane ogłoszenia
        $user->announcements()->delete();

        // Usuń użytkownika
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Użytkownik został usunięty.');
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);

        // Usuń powiązane zdjęcia
        $announcement->photos()->delete();

        // Usuń powiązane rekordy w tabeli bids
        $announcement->bids()->delete();

        // Usuń ogłoszenie
        $announcement->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Ogłoszenie zostało usunięte.');
    }
}
