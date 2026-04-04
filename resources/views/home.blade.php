@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (auth()->user())
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ auth()->user()->name }} - {{ __('You are logged in!') }}
                        </div>
                    </div>
                @else
                    <h1>Welecome Guest</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
