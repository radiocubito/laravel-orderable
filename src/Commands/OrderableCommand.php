<?php

namespace Radiocubito\Orderable\Commands;

use Illuminate\Console\Command;

class OrderableCommand extends Command
{
    public $signature = 'orderable';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
