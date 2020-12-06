<?php

namespace App\Listeners;

use App\Events\SendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
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
     * @param  SendNotification  $event
     * @return void
     */
    public function handle(SendNotification $event)
    {
        $details = $event->details;
        \Mail::to($details['to'])->send(new \App\Mail\EmailService($details));
    }
}
