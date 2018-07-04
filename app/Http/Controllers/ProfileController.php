<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show profile page of the user.
     *
     * @return Response
     */
     public function show() {
         $user = Auth::User();
         return view('profile.index', compact('user'));
     }
}
