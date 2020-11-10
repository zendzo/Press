<?php

namespace zendzo\Press\Fields;

abstract class FieldContract
{
  public static function process($typeField, $typeValue, $data)
  {
    return [
      $typeField => $typeValue
    ];
  }
}
