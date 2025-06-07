@component('mail::message')
# Application Approved

Dear {{ $tenant->name }},

Your tenant application has been approved! Here are your login credentials:

**Admin Email:** {{ $tenant->admin_email }}  
**Password:** {{ $password }}  
**Subdomain:** {{ $tenant->subdomain }}.dineflow.com  
**Subscription Plan:** {{ ucfirst($tenant->plan) }}

You can now login at: http://{{ $tenant->subdomain }}.dineflow.com:8000/welcome

Please change your password after your first login.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
