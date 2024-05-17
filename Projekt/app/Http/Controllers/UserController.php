<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //🧟🧟
    public function user($id){
        $user=User::find($id);
        return view('cars.user', compact('user'));
    }
}
