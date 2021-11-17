<?php

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Mail\NotifyAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifyAdminOnContactCreated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ContactCreated $event)
    {
        Mail::to(User::find(1))->queue(new NotifyAdmin($event->contact));
    }
}
