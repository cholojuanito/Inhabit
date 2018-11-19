@extends('layouts.master') 
@section('content')
<div class="container">
    <div class="columns">
        @include('layouts.sidenav')
        <div class="container has-top-margin">
            <div class="column is-6 is-offset-2">
                <div class="box">
                    <div class="title">New Listing</div>

                    <form class="form-horizontal" method="POST" action="{{ route('listing.store') }}">
                        {{ csrf_field() }}

                        <input id="user_id" name="user_id" type="hidden" value="{{ $user->id }}">

                        <p class="subtitle">
                            Manager Info
                        </p>
                        <div class="field">
                            <label for="contact_name" class="label">Manager's Name</label>
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="input {{ $errors->has('contact_name') ? ' is-danger' : '' }}" id="contact_name" name="contact_name" placeholder="John Smith" value="{{ $user->name}}" required>
                                @if ($errors->has('contact_name'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="contact_email" class="label">Manager's Email</label>
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" class="input {{ $errors->has('contact_email') ? ' is-danger' : '' }}" id="contact_email" name="contact_email" placeholder="john@smith.net" value="{{ $user->email }}" required>
                                @if ($errors->has('contact_email'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="contact_phone" class="label">Manager's Phone Number</label>
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" class="input {{ $errors->has('contact_email') ? ' is-danger' : '' }}" id="contact_phone" name="contact_phone" placeholder="(800) 123-4567" value="{{ old('contact_phone') }}" required autofocus>
                                @if ($errors->has('contact_phone'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('contact_phone') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <p class="subtitle">
                            Apartment Info
                        </p>
                        <div class="field">
                        <label for="street_address" class="label">Street Address</label>
                            <div class="control">
                                <input id="street_address" type="text" class="input {{ $errors->has('street_address') ? ' is-danger' : '' }}" name="street_address" value="{{ old('street_address') }}" placeholder="123 Main St" required> 
                                @if ($errors->has('street_address'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('street_address') }}</strong>
                                    </p>
                                @endif
                            </div>                     
                        </div>

                        <div class="field">
                            <label for="apt_num" class="label">Apt #</label>

                            <div class="control">                        
                                <input id="apt_num" type="text" class="input {{ $errors->has('apt_num') ? ' is-danger' : '' }}" name="apt_num" placeholder="36, #36, etc..." value="{{ old('apt_num') }}"> 
                                @if ($errors->has('apt_num'))
                                    <strong class="help is-danger">{{ $errors->first('apt_num') }}</strong>
                                @else
                                    <p class="help">* Optional.</p>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="city" class="label">City</label>

                            <div class="control">                        
                                <input id="city" type="text" class="input {{ $errors->has('city') ? ' is-danger' : '' }}" name="city" placeholder="Manhattan, Sacramento, etc..." value="{{ old('city') }}" required> 
                                @if ($errors->has('city'))
                                    <strong class="help is-danger">{{ $errors->first('city') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="state" class="label">State</label>
                            <div class="control">
                                <div class="select">
                                    <select id="state" name="state" required>
                                        @foreach ($states as $state)
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label for="date_available" class="label">Availability Date</label>
                            <div class="control">
                                <input type="date" class="input {{ $errors->has('date_available') ? ' is-danger' : '' }}" id="date_available" name="date_available" value="{{ old('date_available') }}" required>
                            </div>
                            @if ($errors->has('date_available'))
                                <strong class="help is-danger">{{ $errors->first('date_available') }}</strong>
                            @endif
                        </div>

                        <div class="field is-expanded">
                            <label for="monthly_price" class="label">Monthly Rate</label>
                            <div class="field has-addons">
                                <p class="control">
                                    <a class="button is-static">
                                        $
                                    </a>
                                </p>
                                <p class="control is-expanded">
                                    <input class="input {{ $errors->has('monthly_price') ? ' is-danger' : '' }}" type="number" name="monthly_price" min="1" value="{{ old('monthly_price') }}" required>
                                </p>
                            </div>
                            @if ($errors->has('monthly_price'))
                                <strong class="help is-danger">{{ $errors->first('monthly_price') }}</strong>
                            @else
                                <p class="help">Must be greater than zero.</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="description" class="label">Brief Description</label>

                            <div class="description">                        
                                <textarea id="description" class="textarea {{ $errors->has('description') ? ' is-danger' : '' }}" name="description" value="{{ old('description') }}" required></textarea>
                                @if ($errors->has('description'))
                                    <strong class="help is-danger">{{ $errors->first('description') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="num_beds" class="label">Number of Bedrooms</label>
                            <div class="control">
                                <input type="number" class="input {{ $errors->has('num_beds') ? ' is-danger' : '' }}" id="num_beds" name="num_beds" step="0.5" min="0.5" max="20" value="{{ old('num_beds') }}" required>
                                @if ($errors->has('num_beds'))
                                    <strong class="help is-danger">{{ $errors->first('num_beds') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="num_baths" class="label">Number of Bathrooms</label>
                            <div class="control">
                                <input type="number" class="input {{ $errors->has('num_baths') ? ' is-danger' : '' }}" id="num_baths" name="num_baths" step="0.5" min="0.5" max="20" value="{{ old('num_baths') }}" required>
                                @if ($errors->has('num_baths'))
                                    <strong class="help is-danger">{{ $errors->first('num_baths') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="square_ft" class="label">Square Feet</label>
                            <div class="control">
                                <input type="number" class="input {{ $errors->has('square_ft') ? ' is-danger' : '' }}" id="square_ft" name="square_ft" min="0" value="{{ old('square_ft') }}" required>
                                @if ($errors->has('square_ft'))
                                    <strong class="help is-danger">{{ $errors->first('square_ft') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection