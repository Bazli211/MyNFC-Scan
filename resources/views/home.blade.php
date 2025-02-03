@extends('layouts.app')
<style type="text/css">
/* Default (Light Mode) */
body {
    background-color: #ffffff;
    color: #000000;
}

.card {
    background-color: #f8f9fa;
    color: #000000;
}

/* Night Mode */
body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}

.card.dark-mode {
    background-color: #1e1e1e;
    color: #ffffff;
}

/* Button styles */
.toggle-dark-mode {
    cursor: pointer;
    padding: 10px 20px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
}

.toggle-dark-mode:hover {
    background-color: #0056b3;
}
</style>
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

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

