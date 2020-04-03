<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Subscription;
use App\User;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::where('user_id', auth()->user()->id)->get();
        $user = User::find(auth()->user()->id);

        return view('subscriptions.index', compact('subscriptions', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Plan $plan)
    {
        if($request->user()->subscribedToPlan($plan->stripe_plan, $plan->name)) {
            return redirect()->route('home')->with('success', 'You have already subscribed the plan');
        }

        $plan = Plan::findOrFail($request->get('plan'));
        
        $request->user()
            ->newSubscription($plan->name, $plan->stripe_id)
            ->trialDays(30)
            ->create($request->stripeToken);
        
        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelSubscription($id) 
    {
        $subscription = Subscription::where('stripe_id', $id)->first();
        $user = User::find(auth()->user()->id);
        $user->subscription($subscription->name)->cancel();
        
        return redirect()->back()->with('success', 'Your plan cancelled successfully');
    }
}
