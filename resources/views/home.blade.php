@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->role == 1)
                        selamat datang admin
                    @elseif (Auth::user()->role == 2)
                        selamat datang kasir
                    @elseif (Auth::user()->role == 3)
                        selamat datang mas haikal yang paling ganteng unch unch
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
