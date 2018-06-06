<?php

namespace App\Providers;

use App\Channel;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);

    // Localization Carbon
    \Carbon\Carbon::setLocale(config('app.locale'));

    // channels
    \View::composer('*', function ($view) {
      $channels = \Cache::rememberForever('channels', function (){
        return Channel::all();
      });

      $view->with('channels', $channels);
    });

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    if($this->app->isLocal()){
      $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
    }
  }
}
