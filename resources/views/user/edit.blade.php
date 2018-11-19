@extends('layouts.master') 
@section('content')

<div class="container is-fluid">
    <div class="columns">
        @include('layouts.sidenav')
        <div class="column is-10">
            <user-form :user="{{ $user }}" inline-template v-cloak>
                <section class="box">
                    <div class="title">Edit Your Profile</div>

                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/user/{{ $user->id }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">
                        <label for="name" class="label">Change Name</label>
                        <div class="field">
                            <div class="control is-expanded has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="name" type="text" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $user->name }}" placeholder="First Name" required autofocus> 
                                    @if ($errors->has('name'))
                                        <strong class="help is-danger">{{ $errors->first('name') }}</strong>
                                    @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="email" class="label">Change E-Mail</label>

                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $user->email }}" required> 
                                    @if ($errors->has('email'))
                                        <strong class="help is-danger">{{ $errors->first('email') }}</strong>
                                    @endif
                            </div>
                        </div>
                            <div class="field">
                                <label for="profile_pic" class="label">Change Profile Photo</label>                   
                                <div class="file has-name">
                                    <label class="file-label">
                                        <single-image-upload id="profile_pic" name="profile_pic" @loaded="onLoad"></single-image-upload>
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fa fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Choose a file…
                                            </span>
                                        </span>
                                        <span class="file-name">
                                            @{{ profilePic }}
                                        </span>
                                    </label>
                                </div>
                                @if ($errors->has('profile_pic'))
                                    <strong class="help is-danger">{{ $errors->first('profile_pic') }}</strong>
                                @endif
                            </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">
                                    Edit
                                </button>
                            </div>
                        </div>  
                    </form>
                </section>
            </user-form>
        </div>
    </div>
</div>

@endsection