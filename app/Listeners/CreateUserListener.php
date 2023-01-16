<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserListener implements ShouldQueue
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
     * @param  \App\Events\CreateUserEvent  $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        $name = $event->data['name'];
        $email = $event->data['email'];
        $content = "name: $name - username: $email";

        file_put_contents(storage_path('data.txt'), $content);
    }
}
