@component('mail::message')
# Hello Admin,

You received a new message from {{ $contact->name }}

## Here are the details: <br>
Name: {{ $contact->name }} <br>
Email: {{ $contact->email }} <br>
Message: {{ $contact->content }} <br>

@component('mail::button', ['url' => '$url'])
View Message
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
