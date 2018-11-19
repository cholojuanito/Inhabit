@component('mail::message')
    
    #One last step!

    We just need you to verify your email and humanity.

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])

        Confirm Email
    
@endcomponent

    Thanks again!

    - The Team at {{ config('app.name') }}
    
@endcomponent


