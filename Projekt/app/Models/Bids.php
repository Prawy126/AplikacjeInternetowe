<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Bids extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'announcement_id', 'amount', 'time'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }
    public function store(Request $request, $announcementId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $announcement = Announcement::findOrFail($announcementId);
        $latestBid = $announcement->bids()->orderBy('amount', 'desc')->first();

        $minBidAmount = $latestBid ? $latestBid->amount : $announcement->min_price;
        if ($request->amount <= $minBidAmount) {
            return back()->withErrors(['amount' => 'Twoja oferta musi być wyższa niż obecna najwyższa oferta.']);
        }

        $bid = new Bids();
        $bid->announcement_id = $announcement->id;
        $bid->user_id = Auth::id();
        $bid->amount = $request->amount;
        $bid->time = now();
        $bid->save();

        return back()->with('success', 'Twoja oferta została złożona.');
    }
}
