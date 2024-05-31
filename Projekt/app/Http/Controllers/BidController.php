<?php
namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, $announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);

        if ($announcement->is_end || $announcement->end_date < now()) {
            return redirect()->route('cars.show', $announcementId)->with('error', 'Nie można dodać oferty do zakończonej aukcji.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        Bid::create([
            'user_id' => Auth::id(),
            'announcement_id' => $announcementId,
            'amount' => $request->amount,
            'time' => now(),
        ]);

        return redirect()->route('cars.show', $announcementId)->with('success', 'Oferta została dodana.');
    }
}
