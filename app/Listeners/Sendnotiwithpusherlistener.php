<?php

namespace App\Listeners;

use App\Events\Sendnotiwithpusher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Sendnotiwithpusherlistener
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
     * @param  Sendnotiwithpusher  $event
     * @return void
     */
    public function handle(Sendnotiwithpusher $event)
    {
        //
      $event->test;
    }
}
