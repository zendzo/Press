<?php

namespace zendzo\Press\Console;

use illuminate\Console\Command;
use illuminate\Support\Str;
use zendzo\Press\Models\Post;
use zendzo\Press\Facades\Press;

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
    if (Press::configNotPublish()) {
      $this->warn('please publish the config by running ' . '\'php artisan vendor:publish --tag=press-config\'');
    }

    try {
      $posts = Press::driver()->fetchPosts();

      foreach ($posts as $post) {
        Post::create([
          'identifier' => $post['identifier'],
          'slug' => Str::slug($post['title']),
          'title' => $post['title'],
          'body' => $post['body'],
          'extra' => $post['extra'] ?? null
        ]);
      }
    } catch (\Exception $e) {
      $this->error($e->getMessage());
    }
  }
}
