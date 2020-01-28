@extends('frontend.app', ['activePage' => 'register', 'title' => __('My Adjustr')])

@section('content')
    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>Join as a professional</h1>
                    <hr class="blue-line">
                </div>
            </div>
            <form class="form-join" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row justify-content-center{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name...') }}" value="{{ old('name') }}" required>
                        </div>
                        @if ($errors->has('name'))
                            <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
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
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" required>
                        </div>
                        @if ($errors->has('password'))
                            <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password...') }}" required>
                            <small class="text-center form-text text-muted">By clicking Create Account you agree to the Terms of Use and Privacy Policy</small>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col">
                        <button  type="submit" class=" mt-4 btn btn-primary">Create Account</button>
                    </div>
                </div>

                <div class="row mt-4 text-center">
                    <div class="col">
                        <a class="mr-3" href="{{ route('login') }}">Already have an account?</a>
                        <a href="{{ route('login') }}"><b>Log In</b></a>
                    </div>
                </div>

            </form>
        </div>

    </section>
@endsection
