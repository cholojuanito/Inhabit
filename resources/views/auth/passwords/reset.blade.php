@extends('layouts.master')

@section('content')
<div class="container has-text-centered has-top-margin">
    <div class="column is-6 is-offset-3">
        <div class="box">
            <div class="title">Reset Password</div>

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="field {{ $errors->has('email') ? ' is-danger' : '' }}">
                            <label for="email" class="label">E-Mail</label>

                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="input" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <strong class="help is-danger">{{ $errors->first('email') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field {{ $errors->has('password') ? ' is-danger' : '' }}">
                            <label for="password" class="label">Password</label>

                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input id="password" type="password" class="input" name="password" required>

                                @if ($errors->has('password'))
                                    <strong class="help is-danger">{{ $errors->first('password') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}">
                            <label for="password-confirm" class="label">Confirm Password</label>
                            
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <strong class="help is-danger">{{ $errors->first('password_confirmation') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
