<?php

namespace zendzo\Press\Console;

use illuminate\Console\Command;
use illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use zendzo\Press\PressFileParser;
use zendzo\Press\Models\Post;

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
        if (is_null(config('press'))) {
          $this->warn('please publish the config by running '.'\'php artisan vendor:publish --tag=press-config\'');
        }
        // fetch all post
        $files = File::files(config('press.path'));
        // process each file
        foreach ($files as $file) {
          $post = (new PressFileParser($file->getPathname()))->getData();
        }
        // presist to the DB
         Post::create([
          'identifier' => Str::random(16),
          'slug' => Str::slug($post['title']),
          'title' => $post['title'],
          'body' => $post['body'],
          'extra' => $post['extra'] ?? null
         ]);
    }
}
