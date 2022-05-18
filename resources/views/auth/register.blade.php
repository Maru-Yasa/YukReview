@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">Gender</label>
                            <div class="col-md-6">
                                <select class="form-select" name="gender" id="">
                                    <option value="other" selected>Other</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                  </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">Captcha</label>
                            <div class="col-md-6 captcha">
                                <span id="captcha_img">{!! captcha_img() !!}</span>
                                <button onclick="reloadCaptcha()" type="button" class="btn btn-primary " class="reload" id="reload">
                                &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">Enter Captcha</label>
                            <div class="col-md-6">
                                <input id="captcha" required type="text" class="form-control  @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                            </div>

                            @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
