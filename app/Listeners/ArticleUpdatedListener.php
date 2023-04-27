<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ArticleUpdatedListener
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
     * @param  \App\Events\ArticleUpdated  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        //
    }
}
