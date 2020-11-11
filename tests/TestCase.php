<?php

namespace zendzo\Press\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use zendzo\Press\PressBaseServiceProvider;

// the base class TestCase should be abstract class https://github.com/sebastianbergmann/phpunit/issues/3916#issuecomment-547584947
// otherwise PHPUnit  return a warning no test in TestCase
abstract class TestCase extends TestCase
{
  public function getPackageProviders($app)
  {
    return [
      PressBaseServiceProvider::class
    ];
  }

  public function getEnvironmentSetup($app)
  {
      $app['config']->set('database.default', 'testdb');
      $app['config']->set('database.connections.testdb ', [
        'driver' => 'sqlite',
        'database' => ':memory:'
      ]);
  }
}
