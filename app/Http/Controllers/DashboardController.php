<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->roles === 1){
            return redirect()->intended(route('seller.dashboard', absolute: false));
        }
        if(Auth::user()->roles === 2){
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }
        return redirect()->intended(route('user.dashboard', absolute: false));
    }
}
