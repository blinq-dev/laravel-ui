<?php

namespace Blinq\UI\Commands;

use Illuminate\Console\Command;

class UICommand extends Command
{
    public $signature = 'ui';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
