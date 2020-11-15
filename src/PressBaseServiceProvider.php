<?php

namespace zendzo\Press;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use zendzo\Press\Facades\Press;

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
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'press');

    // register facades first berfore everything else
    $this->registerFacades();
    $this->registerRoutes();
  }

  protected function registerRoutes()
  {
    Route::group($this->routeConfigurations(), function () {
      $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    });
  }

  protected function regsiterPublishing()
  {
    $this->publishes([
      __DIR__ . '/../config/press.php' => config_path('press.php')
    ], 'press-config');
  }

  protected function routeConfigurations()
  {
    return [
      'prefix' => Press::path(),
    ];
  }

  protected function registerFacades()
  {
    $this->app->singleton('Press', function ($app) {
      return new \zendzo\Press\Press();
    });
  }
}
