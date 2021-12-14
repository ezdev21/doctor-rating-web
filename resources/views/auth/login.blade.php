@extends('layouts.app')

@section('content')
<div class="m-5 p-5 bg-white mx-auto rounded-3xl w-full lg:w-1/2 xl:w-1/2 2xl:w-1/2">
    <div class="">
        <div class="">
            <div class="">
                {{-- <a href="{{route('login.google')}}" class="no-underline hover:no-underline">
                   <div class="bg-google px-5 py-1 my-2 mx-auto rounded-xl w-2/3 mx-auto text-2xl border-2 border-google text-google flex">
                    <img src="/storage/icons/google.jpg" class="m-1 w-8">
                    <p class="text-google mx-1">sign in with google</p>
                   </div>
                </a>
                <a href="{{route('login.facebook')}}" class="no-underline hover:no-underline">
                   <div class="bg-facebook px-5 py-1 my-2 mx-auto rounded-xl w-2/3 mx-auto text-2xl border-2 text-tiruhakim border-tiruhakim px-auto flex"> 
                    <img src="/storage/icons/facebook.png" class="m-1 w-8">
                    <p class="text-white mx-1">sign in with facebook</p>
                   </div> 
                </a> --}}
                <div class="text-2xl text-tiruhakim text-center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn bg-tiruhakim px-5 py-2 rounded-3xl text-2xl text-white">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-tiruhakim text-xl" href="{{ route('password.request') }}">
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
