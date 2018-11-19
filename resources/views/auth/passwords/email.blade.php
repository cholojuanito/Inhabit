@extends('layouts.master')

@section('content')
<div class="container has-text-centered has-top-margin">
    <div class="column is-6 is-offset-3">
        <div class="box">
                <div class="title">Request Password Reset</div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

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

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
