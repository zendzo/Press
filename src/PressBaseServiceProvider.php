<?php

namespace zendzo\Press;

use Illuminate\Support\ServiceProvider;

class PressBaseServiceProvider extends ServiceProvider
{
  public function boot()
  {
    if ($this->app->runningInConsole()) {
      $this->regsiterPublishing();
    }
      $this->registerResources();
  }

  public function register()
  {
      $this->commands([
        Console\ProcessCommand::class
      ]);
  }

  public function registerResources()
  {
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
  }

  protected function regsiterPublishing()
  {
    $this->publishes([
      __DIR__.'/../config/press.php' => config_path('press.php')
    ], 'press-config');
  }
}
