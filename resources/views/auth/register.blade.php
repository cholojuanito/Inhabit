@extends('layouts.master') 
@section('content')
<div class="container has-text-centered has-top-margin">
    <div class="column is-6 is-offset-3">
        <div class="box">
            <div class="title">Sign up</div>

            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <label for="name" class="label">Name</label>
                <div class="field">
                    <div class="control is-expanded has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                        <input id="name" type="text" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" placeholder="John Smith" required autofocus> 
                        @if ($errors->has('name'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="email" class="label">E-Mail</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" placeholder="john@smith.net" required> 
                        @if ($errors->has('email'))
                            <strong class="help is-danger">{{ $errors->first('email') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="label">Password</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required> 
                        @if ($errors->has('password'))
                            <strong class="help is-danger">{{ $errors->first('password') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password-confirm" class="label">Confirm Password</label>

                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input id="password-confirm" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password_confirmation" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link">
                            Sign up
                        </button>
                    </div>
                </div>
                <div class="is-divider" data-content="OR"></div>
                <div class="field">
                    <span>Sign up with </span>
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