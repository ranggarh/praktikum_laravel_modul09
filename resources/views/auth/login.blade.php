@extends('layouts.applogin')

@section('content')


<div class="container-sm p-5 mt-3">
    <div class="row justify-content-center">
        <div class="p-5 bg-light rounded-3 col-xl-5 border">
            <div class="mb-3 text-center">
                <i class="bi-hexagon-fill fs-1 text-primary"></i>
                <h4>Login Employee</h4>
            </div>
            <hr>
            <div class="row">
            <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-13">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email Anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-2 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-13">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Password Anda">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-13 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>

        </div>
        <hr>
    </div>
</div>

@endsection
