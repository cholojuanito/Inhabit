@extends('layouts.master') 
@section('content')
<div class="container has-text-centered has-top-margin">
    <div class="column is-6 is-offset-3">
        <div class="box">
            <div class="title">Login</div>

            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="field {{ $errors->has('email') ? ' is-danger' : '' }}">
                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" placeholder="EMail" required autofocus> 
                        @if ($errors->has('email'))
                            <strong class="help is-danger">{{ $errors->first('email') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="field {{ $errors->has('password') ? ' is-danger' : '' }}">
                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input id="password" type="password" class="input" name="password" placeholder="Password" required> 
                        @if ($errors->has('password'))
                            <strong class="help is-danger">{{ $errors->first('password') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>


                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link">
                            Login
                        </button>

                        <a class="button is-danger is-inverted" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
                <div class="is-divider" data-content="OR"></div>
                <div class="field">
                    <span>Login with </span>
                </div>
                <div class="field is-grouped is-grouped-centered">
                    <div class="control">
                        <a href="{{ url('/auth/facebook') }}" class="is-fb-button">
                            <span class="icon">
                                <i class="fa fa-facebook"></i>
                            </span>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="control">
                        <a href="{{ url('/auth/google') }}" class="button">
                            <span class="icon">
                                <i class="fa fa-google"></i>
                            </span>
                            <span>Google</span>
                        </a>
                    </div>
                    <div class="control">
                        <a href="{{ url('/auth/linkedin') }}" class="is-linkedin-button">
                            <span class="icon">
                                <i class="fa fa-linkedin"></i>
                            </span>
                            <span>Linkedin</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection