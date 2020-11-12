<?php

namespace zendzo\Press\Tests;

use zendzo\Press\Database\Factories\PostFactory;
use zendzo\Press\Models\Post;

class SavePostTest extends TestCase
{
  /** @test */
  public function test_a_post_can_be_created_using_factories()
  {
      $this->artisan('migrate', ['--database' => 'testbench'])->run();

      $post = factory(Post::class)->create();

      $this->assertCount(1, Post::all());
  }
}
