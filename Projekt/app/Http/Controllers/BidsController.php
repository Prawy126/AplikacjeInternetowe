<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Bids;
use Illuminate\Support\Facades\Auth;

class BidsController extends Controller
{
    public function store(Request $request, $announcementId)
    {

        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);


        $announcement = Announcement::findOrFail($announcementId);


        if ($announcement->user_id == Auth::id()) {
            return back()->withErrors(['amount' => 'Nie możesz licytować swojej oferty!']);
        }


        $latestBid = $announcement->bids()->latest()->first();


        if ($latestBid && $latestBid->user_id == Auth::id()) {
            return back()->withErrors(['amount' => 'Nie możesz przebić własnej oferty!']);
        }


        $minBidAmount = $latestBid ? $latestBid->amount : $announcement->min_price;
        if ($request->amount <= $minBidAmount) {
            return back()->withErrors(['amount' => 'Kwota złożona przez ciebie jest niższa niż aktualnie oferowana.']);
        }


        $bid = new Bids(); // Upewnij się, że klasa to Bid, a nie Bids
        $bid->announcement_id = $announcement->id;
        $bid->user_id = Auth::id();
        $bid->amount = $request->amount;
        $bid->time = now();
        //dd($bid->time);
        $bid->save();

        return back()->with('success', 'Twoja oferta została złożona poprawnie.');
    }



}
