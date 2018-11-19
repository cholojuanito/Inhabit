@extends('layouts.master')

@section('content')

<div class="container is-fluid">
    <div class="columns">
        @include('layouts.sidenav')
        <div class="column is-10">
            <section class="box">
                <div class="level">
                    <div class="level-item">
                        <p class="title">
                            Your Listings
                        </p>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <a href="{{ route('listing.create') }}" class="button is-link is-round">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span> Listing</span>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Got thru all the listings -->
                @if( count($listings) > 0 )
                    <user-listings :listings="{{ $listings }}"></user-listings>

                @else

                    <div class="content">
                        <p class="title">
                            You currently have no listings.
                        </p>
                        <a href="{{ route('listing.create') }}" class="button is-link">
                            Create a listing
                        </a>
                    </div>
                    
                @endif  
            </section>
        </div>
    </div>
</div>
    
@endsection