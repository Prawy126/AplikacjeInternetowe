<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Bid;
use App\Models\Bids;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $timestamps = false;

    public function user($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            $user = User::find($id);
            if (!$user) {
                abort(403);
            }

            $announcements = Announcement::with('photos')->where('user_id', $id)->get();

            $participatingAuctions = Bid::where('user_id', $user->id)
                ->with(['announcement' => function($query) {
                    $query->with('bids');
                }])
                ->get()
                ->groupBy('announcement_id')
                ->map(function ($bids) {
                    return $bids->sortByDesc('amount')->first();
                });

            return view('cars.user', ['user' => $user, 'announcements' => $announcements, 'participatingAuctions' => $participatingAuctions]);
        } else {
            abort(403);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $announcements = $user->announcements->load('bids');

        foreach ($announcements as $announcement) {
            $announcement->highest_bid = $announcement->bids->where('user_id', $user->id)->sortByDesc('amount')->first();
        }

        return view('user.show', ['user' => $user, 'announcements'=>$announcement]);
    }
}
