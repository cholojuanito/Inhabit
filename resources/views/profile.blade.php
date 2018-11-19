@extends('layouts.master') 
@section('content')

<div class="container is-fluid">
    <div class="columns">
        @include('layouts.sidenav')
        <div class="column is-10">
            <section class="box">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <figure class="image is-128x128 is-rounded">
                                <img src="/uploads/avatars/{{ $user->profile_pic }}">
                            </figure>
                        </div>
                        <div class="level-item">
                            <p class="title">
                                {{ $user->name }}'s Profile
                            </p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="content ">
                        <div class="user-name">
                            {{ $user->name }}
                        </div>
                        <div class="user-email">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>

                <a href="/user/{{$user->id}}/edit" class="button">
                    Edit Your Profile
                </a>
            </section>
        </div>
    </div>
</div>

@endsection