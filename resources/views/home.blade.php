@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h2>Home</h2></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <ul class="list-group">
                                <li class="list-group-item clearfix">
                                    User: {{ $user }}
                                </li>
                                <li class="list-group-item clearfix">
                                    Plan: {{ $plan }}
                                </li>
                                <li class="list-group-item clearfix">
                                    Subscription: {{ $subscription }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
