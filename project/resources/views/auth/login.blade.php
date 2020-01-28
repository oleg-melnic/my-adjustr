@extends('frontend.app', ['activePage' => 'login', 'title' => __('My Adjustr')])

@section('content')
    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>Welcome Back</h1>
                    <hr class="blue-line">
                </div>
            </div>
            <form class="form-login" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row justify-content-center{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('Email...') }}" value="{{ old('email', 'admin@material.com') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row justify-content-center{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <input type="password" id="exampleInputEmail1" aria-describedby="emailHelp" name="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "secret" : "" }}" required>
                        </div>
                        @if ($errors->has('password'))
                            <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-4 text-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                </div>

                <div class="row mt-4 text-center">
                    <div class="col">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col text-right"><hr class="form-blue-line d-inline-block"></div>
                    <div class="col-auto"><span class="align-mid align-middle">or</span></div>
                    <div class="col text-left"><hr class="form-blue-line d-inline-block"></div>
                </div>

                <div class="row mt-4 text-center">
                    <div class="col ">
                        <button type="submit" class="btn btn-primary">Log In with Facebook  <i class="ml-1 fab fa-facebook-f"></i></button>
                    </div>
                </div>

                <div class="row mt-3 text-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Log In with Google <i class="ml-1 fab fa-google"></i></button>
                        <p class="mt-4">By clicking Create Account you agree to the Terms of Use and Privacy Policy</p>
                    </div>
                </div>

                <div class="row mt-5 mb-5 text-center">
                    <div class="col">
                        <a class="mr-3" href="{{ route('register') }}">Don’t have an account? </a>
                        <a href="{{ route('register') }}"><b>Sign Up</b></a>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
