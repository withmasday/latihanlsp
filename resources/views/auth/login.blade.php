@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <h3 class="mb-3">Sign In | TOBANTIK</h3>
                            <label for="username">{{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="border-0 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="border-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    {{ __('Sign In') }}
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-outline-primary w-100 py-2" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link mt-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
