@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h2>Subscriptions</h2></div>
                <div class="card-body">
                    <div class="pull-left">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                <th scope="col">User Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Stripe Id</th>
                                <th scope="col">Stripe Status</th>
                                <th scope="col">Stripe Plan</th>
                                <th scope="col">Trial Ends</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $sub)
                                    <tr>
                                        <td>{{ $sub->user_id }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td>{{ $sub->stripe_id }}</td>
                                        <td>{{ $sub->stripe_status }}</td>
                                        <td>{{ $sub->stripe_plan }}</td>
                                        <td>{{ $sub->trial_ends_at }}</td>
                                        <td>
                                            <form action="{{ route('subscriptions.cancel', $sub->stripe_id)}}" method="post">
                                                @csrf
                                                @method('POST')

                                                @if($user->subscription($sub->name)->cancelled()) 
                                                    <button class="btn btn-info" type="submit" disabled>Cancelled</button>
                                                @else
                                                    <button class="btn btn-danger" type="submit">Cancel</button>
                                                @endif
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{ route('subscriptions.resume', $sub->stripe_id)}}" method="post">
                                                @csrf
                                                @method('POST')

                                                @if($user->subscription($sub->name)->cancelled()) 
                                                    <button class="btn btn-success" type="submit">Resume</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection