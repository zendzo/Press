<?php

namespace zendzo\Press\Drivers;

use Illuminate\Support\Facades\File;
use zendzo\Press\Exceptions\FileDriverDirectoryNotFoundException;

class FileDriver extends Driver
{
  public function fetchPosts()
  {
    $files = File::files($this->config['path']);
    foreach ($files as $file) {
      $this->parse($file->getPathname(), $file->getFilename());
    }

    return $this->posts;
  }

  protected function validateSource()
  {
    if ( ! File::exists($this->config['path'])) {
      throw new FileDriverDirectoryNotFoundException(
        'Directory at \'' . $this->config['path'] . '\' does not exist. check directory path in the config file'
      );
      
    }
  }
}
