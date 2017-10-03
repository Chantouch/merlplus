@component('mail::message')
    # Received message

    ## Dear Admin

    You recently received a message from : {{ $user['name'] }}

    Name: {{ $user['name'] }}

    Email: {{ $user['email'] }}

    Phone: Message: {{ $user['phone'] }}

    Message: {{ $user['user_message'] }}

    @component('mail::button', ['url' => '/'])
        Back Home
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent