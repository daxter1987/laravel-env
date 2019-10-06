<?php

namespace daxter1987\LaravelEnv;
use Illuminate\Support\ServiceProvider;

class LaravelEnvProvider extends ServiceProvider {

    public function boot()
    {
        $this->commands([
            Commands\Create::class,
        ]);
    }

    public function register()
    {
    }
}
