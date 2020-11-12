<?php

namespace zendzo\Press;

use Illuminate\Support\Str;

class Press
{
  public static function configNotPublish()
  {
    return is_null(config('press'));
  }

  public static function driver()
  {
    $driver = Str::title(config('press.driver'));
    $class = 'zendzo\Press\Driver\\' . $driver . 'Driver';

    return new $class;
  }
}
