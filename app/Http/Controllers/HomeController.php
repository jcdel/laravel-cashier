<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Plan;
use App\Subscription;
use Laravel\Cashier\Cashier;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userName =  User::whereId(auth()->user()->id)->first()->name;
        $subscriptions =  Subscription::where('user_id', auth()->user()->id)->get();

        return view('home', compact('userName', 'subscriptions'));
    }
}
