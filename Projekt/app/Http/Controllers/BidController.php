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
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ], [
            'amount.required' => 'Pole kwota jest wymagane.',
            'amount.numeric' => 'Pole kwota musi być liczbą.',
            'amount.min' => 'Pole kwota musi być większe niż 0.',
        ]);

        $announcement = Announcement::findOrFail($announcementId);
        $currentDateTime = now();


        if ($announcement->is_end || $announcement->end_date < $currentDateTime) {
            return redirect()->route('cars.show', ['id' => $announcementId])
                ->withErrors(['Licytacja jest zakończona i nie można składać nowych ofert.']);
        }

        $highestBid = $announcement->bids()->orderBy('amount', 'desc')->first();


        if ($request->amount <= $announcement->min_price || ($highestBid && $request->amount <= $highestBid->amount)) {
            return redirect()->route('cars.show', ['id' => $announcementId])
                ->withErrors(['Kwota musi być większa niż minimalna cena i aktualnie najwyższa oferta.']);
        }


        if ($highestBid && $highestBid->user_id == Auth::id()) {
            return redirect()->route('cars.show', ['id' => $announcementId])
                ->withErrors(['Nie możesz przebijać swojej własnej oferty.']);
        }

        if(Auth::check()){
            Bid::create([
            'announcement_id' => $announcementId,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'time' => $currentDateTime,
        ]);

        return redirect()->route('cars.show', ['id' => $announcementId])
            ->with('success', 'Twoja oferta została złożona.');
        }
        return view('errors.401');
    }
}
