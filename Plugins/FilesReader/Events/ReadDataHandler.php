<?php

namespace Plugins\FilesReader\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Plugins\FilesReader\Services\DataReader;

class ReadDataHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(private DataReader $dataReader)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReadDataEvent $event): void
    {
        $event->reader->read($event->filepath);
    }
}
