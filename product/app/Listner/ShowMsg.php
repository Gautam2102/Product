<?php

namespace App\Listner;

use App\Event\UserCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowMsg
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
     * @param  UserCreate  $event
     * @return void
     */
    public function handle(UserCreate $event)
    {
        //
        echo $event->email;
    }
}
