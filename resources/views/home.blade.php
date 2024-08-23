@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Add a Bootstrap button -->
                        <a href="{{ route('availability.index') }}" class="btn btn-primary mt-3">Manage Availabilities</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
