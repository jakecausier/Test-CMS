@component('mail::message')
# New Media Uploaded

New media content has been uploaded to the site.

@component('mail::panel')
    ![alt text]({{ $content->image_url }} "Media uploaded")
@endcomponent

* Name: {{ $content->name }}
* File size: {{ $content->meta['size'] }}
* Mime type: {{ $content->meta['mime'] }}

@component('mail::button', ['url' => url('/admin/media')])
    Manage media
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
