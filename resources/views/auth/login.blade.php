@extends('layouts.kosong')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-5 mt-5 p-3 shadow rounded-lg">
            <h1 class="fw-bold">Login</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <a href="/register">Don't have any account yet?</a>
                </div>

                <div class="mb-3">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="separator">or</div>
                </div>

                <div class="mb-3">
                    <a class="btn btn-outline-primary d-block rounded-pill" href="{{ route('google_login') }}"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Login With Google</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
