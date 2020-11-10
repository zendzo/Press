<?php

namespace zendzo\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PressFileParser
{
  protected $filename;

  protected $data;

  public function __construct($filename)
  {
    $this->filename = $filename;
    $this->splitFile();
    $this->explodeData();
    $this->processFileds();
  }

  public function getData()
  {
    return $this->data;
  }

  protected function splitFile()
  {
    preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
    File::exists($this->filename) ? File::get($this->filename) : $this->filename, 
    $this->data
    );
  }

  protected function explodeData()
  {
      foreach (explode("\n", trim($this->data[1])) as $fieldString) {
        preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
        $this->data[$fieldArray[1]] = $fieldArray[2];
      }

      $this->data['body'] = trim($this->data[2]);
  }

  public function processFileds()
  {
    foreach ($this->data as $filed => $value) {
      if ($filed === 'date') {
        $this->data[$filed] = Carbon::parse($value);
      }elseif ($filed === 'body') {
        $this->data['body'] = MarkdownParser::parse($value);
      }
    }
  }
}
