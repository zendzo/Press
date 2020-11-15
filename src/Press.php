<?php

namespace zendzo\Press;

use Illuminate\Support\Str;

class Press
{
  public function configNotPublish()
  {
    return is_null(config('press'));
  }

  public function driver()
  {
    $driver = Str::title(config('press.driver'));
    $class = 'zendzo\Press\Drivers\\' . $driver . 'Driver';

    return new $class;
  }

  public function path()
  {
    return config('press.path');
  }
}
