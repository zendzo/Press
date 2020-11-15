<?php

namespace zendzo\Press\Repositories;

use Illuminate\Support\Arr;
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
        'extra' => $this->extra($post)
      ]
      );
  }

  private function extra($post)
  {
    $extra = (array) json_decode($post['extra'] ?? '[]');
    $attributes = Arr::except($post, ['identifier','title', 'body','extra']);
    
    
    return json_encode(array_merge($extra, $attributes));
  }
}
