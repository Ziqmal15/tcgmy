<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $orders = $user->orders;
        $profile = $user->profile;
        return view('pages.user.dashboard', compact('user', 'profile', 'orders'));
    }

}
