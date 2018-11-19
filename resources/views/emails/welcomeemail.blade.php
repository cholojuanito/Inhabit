@component('mail::message')
    
    Welcome to {{ config('app.name') }}!

    We hope you enjoy browsing rental housing to help you find your new apartment.
    Below we have provided you with some options.

Looking to find a new apartment?
@component('mail::button', ['url' => '/'])

        Browse listings
    
@endcomponent
Looking to sell your contract?
@component('mail::button', ['url' => '/home'])

        Post your own listing
    
@endcomponent
Share the love!
@component('mail::button', ['url' => '/'])

        Invite your friends & family!
    
@endcomponent

    Thanks again!<br>

    - The Team at {{ config('app.name') }}
    
@endcomponent


