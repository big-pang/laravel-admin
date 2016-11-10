<?php

namespace App\Listeners;

use App\Events\permChangeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;
class permChangeListener
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
     * @param  permChangeEvent $event
     * @return void
     */
    public function handle(permChangeEvent $event)
    {
        Cache::store('file')->forget('menus');//清理缓存
    }

}