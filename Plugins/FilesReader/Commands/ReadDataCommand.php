<?php

namespace Plugins\FilesReader\Commands;

use Illuminate\Console\Command;
use Plugins\FilesReader\Services\DataReader;

class ReadDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read json data and insert it into mongodb';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new DataReader())->execute();
    }
}
