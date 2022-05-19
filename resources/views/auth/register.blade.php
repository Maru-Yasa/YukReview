@extends('layouts.kosong')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-6 shadow rounded p-4">
            <h1 class="fw-bold">Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>

                    <div class="">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Gender</label>
                    <div class="">
                        <select class="form-select" name="gender" id="">
                            <option value="other" selected>Other</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="captcha" class="form-label">Enter Captcha</label>
                    <div class="captcha my-2">
                        <span id="captcha_img">{!! captcha_img() !!}</span>
                        <button onclick="reloadCaptcha()" type="button" class="btn btn-primary " class="reload" id="reload">
                        &#x21bb;
                        </button>
                    </div>
                    <div class="">
                        <input id="captcha" required type="text" class="form-control  @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                    </div>

                    @error('captcha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <a href="/login">Alredy have an account?</a>
                </div>

                <div class="mb-3">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function reloadCaptcha(params) {
        var url = "{{ route('reloadCaptcha') }}"
        fetch(url, {
            method:"GET",
        })
        .then(response => response.json())
        .then((response) => {
            let data  =  response.captcha;
            let span = document.getElementById('captcha_img');
            span.innerHTML = data;
        })
    }
</script>

@endsection
