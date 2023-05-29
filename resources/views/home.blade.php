@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <h4>Hello, {{Auth::user()->name}}</h4>
                    <span class="text-secondary">Welcome to Dashboard</span>
                </div>
            </div>
        </div>
    </div>
@endsection
