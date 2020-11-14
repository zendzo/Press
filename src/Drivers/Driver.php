<?php

namespace zendzo\Press\Drivers;

use illuminate\Support\Str;
use zendzo\Press\PressFileParser;

abstract class Driver
{
    protected $posts = [];

    protected $config;

    public function __construct()
    {
      $this->setConfig();
      $this->validateSource();
    }

    /**
     * abstract function must be impletemented for inheritance
     * otherwise will throw an error does not implement abstract method
     */
    public abstract function fetchPosts();

    protected function setConfig()
    {
      // equak to e.g press.driver.file
      // then each key will have a value to be extendable
      $this->config = config('press.' . config('press.driver'));
    }

    /**
     * return true to set this function optional to overwrite
     * due inheritance this function will be automaticlly called
     * 
     * @return void
     */
    protected function validateSource()
    {
      return true;
    }

    protected function parse($content, $identifier)
    {
      $this->posts[] = array_merge(
      (new PressFileParser($content))->getData(),
      ['identifier' => Str::slug($identifier)]
      );
    }
}
