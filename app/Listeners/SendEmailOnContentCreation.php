<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Notifications\ImageUploadedNotification;
use Notification;

class SendEmailOnContentCreation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $content = $event->content;
        $user = User::find(1);

        if ($content->type === 'media' && empty($content->parent_id)) {
            Notification::send($user, new ImageUploadedNotification($content));
        }
    }
}
