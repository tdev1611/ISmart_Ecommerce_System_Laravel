@extends('layouts.app')
@section('content')
    <style>
        #eye {
            position: absolute;
            right: 2%;
            top: 70%;
            cursor: pointer;
        }
    </style>
    <div class="login-wrap p-4 p-md-5">
        <div class="d-flex">
            <div class="w-100">
                <h3 class="mb-4">{{ __('Login') }}</h3>
            </div>
        </div>
        <div>
            <a class="login-fb" href="{{ route('facebook.redirect') }}">Đăng nhập bằng Facebook</a>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label class="label" for="name">{{ __('Email') }}</label>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="password">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                    <i id="eye" class="fa-regular fa-eye"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                    {{ __('Login') }}</button>
            </div>
            <div class="form-group d-md-flex">
                <div class="w-50 text-left">
                    <label class="checkbox-wrap checkbox-primary mb-0"> {{ __('Remember Me') }}
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="w-50 text-md-right">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
        <p class="text-center"> {{ __('Bạn đăng ký chưa ? ') }}<a href="{{ route('register') }}">{{ __('Register') }}</a>
        </p>
    </div>
    {{-- <i class="fa-regular fa-eye-slash"></i> --}}
    <script>
        $('#eye').click(function() {
            $(this).toggleClass('open');
            $(this).toggleClass('fa-eye-slash fa-eye')
            if ($(this).hasClass('open')) {
                $(this).prev().attr('type', 'text')
            } else {
                $(this).prev().attr('type', 'password')
            }
        })
    </script>
@endsection
