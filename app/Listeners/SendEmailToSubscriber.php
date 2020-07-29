<?php

namespace App\Listeners;

use App\Events\NotifySubscriber;
use App\Mail\NotifyUser;
use App\User;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscriber
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
     * @param NotifySubscriber $event
     * @return void
     */
    public function handle(NotifySubscriber $event)
    {
        $users = User::where('subscription', true)->get();
        foreach ($users as $user) {
            Mail::to($user)->send(new NotifyUser($event->author, $event->blog, $user));
        }

        //
    }
}
