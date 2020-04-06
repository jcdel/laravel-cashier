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
                <div class="card-header"><h2>Welcome {{ $user->name }}!</h2></div>
                <div class="card-body">
                    <div class="pull-left">
                        <h5>Active Subscriptions:</h5>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                <th scope="col">User Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Stripe Id</th>
                                <th scope="col">Stripe Status</th>
                                <th scope="col">Stripe Plan</th>
                                <th scope="col">Trial Ends</th>
                                <th scope="col">Status</th>
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
                                        <td>{{ ($user->subscription($sub->name)->cancelled() ? 'Cancelled' : 'Active') }}</td>
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
