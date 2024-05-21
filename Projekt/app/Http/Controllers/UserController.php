<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $timestamps = false;

    public function user($id)
    {
            if (Auth::check() && Auth::id() == $id) {
                $user = User::find($id);
                if (!$user) {
                    abort(403); // Jeśli użytkownik nie zostanie znaleziony, wyświetl stronę 403
                }
                $announcements = Announcement::with('photos')->where('user_id', $id)->get();

                return view('cars.user', compact('user', 'announcements'));
            } else {
                abort(403); // Jeśli użytkownik nie jest zalogowany lub nie jest właścicielem profilu, wyświetl stronę 403
            }

    }
}
