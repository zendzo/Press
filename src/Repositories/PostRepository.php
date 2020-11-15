<?php

namespace zendzo\Press\Repositories;

use illuminate\Support\Str;
use zendzo\Press\Models\Post;

class PostRepository
{
  public function save($post)
  {
      Post::updateOrCreate([
        'identifier' => $post['identifier']
      ],
      [
        'slug' => Str::slug($post['title']),
        'title' => $post['title'],
        'body' => $post['body'],
        'extra' => $post['extra'] ?? json_encode([])
      ]
      );
  }
}
