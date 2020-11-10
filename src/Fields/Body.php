<?php

namespace zendzo\Press\Fields;

use zendzo\Press\MarkdownParser;

class Body extends FieldContract
{
  public static function process($type, $value, $data)
  {
    return [
      $type => MarkdownParser::parse($value)
    ];
  }
}
