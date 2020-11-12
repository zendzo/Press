<?php

namespace zendzo\Press\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use zendzo\Press\PressBaseServiceProvider;

// the base class TestCase should be abstract class https://github.com/sebastianbergmann/phpunit/issues/3916#issuecomment-547584947
// otherwise PHPUnit  return a warning no test in TestCase
abstract class TestCase extends TestbenchTestCase
{

  protected function setUp(): void
  {
      parent::setUp();

      // these line blow only required for legacy factory
      // because we use legacy based factory by composer require  "laravel/legacy-factories": "^1.0.4"
      // these line must be exist
      $this->withFactories(__DIR__.'/../database/factories');
  }

  protected function getPackageProviders($app)
  {
    return [
      PressBaseServiceProvider::class
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('database.default', 'testbench');
    $app['config']->set('database.connections.testbench', [
      'driver'   => 'sqlite',
      'database' => ':memory:',
      'prefix'   => '',
    ]); 
  }
}
