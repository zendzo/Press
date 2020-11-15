<?php

namespace zendzo\Press\Console;

use illuminate\Console\Command;
use illuminate\Support\Str;
use zendzo\Press\Models\Post;
use zendzo\Press\Facades\Press;
use zendzo\Press\Repositories\PostRepository;

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

  public function handle(PostRepository $postRepository)
  {
    if (Press::configNotPublish()) {
      $this->warn('please publish the config by running ' . '\'php artisan vendor:publish --tag=press-config\'');
    }

    try {
      $posts = Press::driver()->fetchPosts();
      $this->info('Number of Post : ' . count($posts));
      foreach ($posts as $post) {
        $postRepository->save($post);
        $this->info('Post : '. $post['title']);
      }
    } catch (\Exception $e) {
      $this->error($e->getMessage());
    }
  }
}
