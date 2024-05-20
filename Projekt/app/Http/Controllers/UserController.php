<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($id)
    {
        $user = User::find($id);
        $announcements = Announcement::with('photos')->where('user_id', $id)->get();

        return view('cars.user', compact('user', 'announcements'));
    }
}
