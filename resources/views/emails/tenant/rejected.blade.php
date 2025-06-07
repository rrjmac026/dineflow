@component('mail::message')
# Application Status Update

Dear {{ $tenant->name }},

We regret to inform you that your tenant application has been rejected.

If you believe this is an error or would like to submit a new application, please contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
