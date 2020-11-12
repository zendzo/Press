<?php

namespace zendzo\Press\Console;

use illuminate\Console\Command;

class ProcessCommand extends Command
{
    /**
     * the name and signature of command
     * @var string
     */
    protected $signature = "press:process";

    /**
     * the description of command
     * @var string
     */
    protected $description = "Update blod post.";

    /**
     * Create new command instance
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    public function handle()
    {
        $this->info('Hello World \n');
    }
}
