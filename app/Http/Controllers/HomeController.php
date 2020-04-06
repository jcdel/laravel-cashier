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
        $user = User::find(auth()->user()->id);
        $subscriptions =  Subscription::where('user_id', auth()->user()->id)
            ->where('stripe_status', '!=', 'canceled')
            ->get();

        return view('home', compact('user', 'subscriptions'));
    }
}
