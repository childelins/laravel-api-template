<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Overtrue\LaravelQueryLogger\ServiceProvider::class);
        }

        // 设置 dingo/api 错误响应格式
        $this->app['Dingo\Api\Exception\Handler']->setErrorFormat([
            'statusCode' => ':status_code',
            'msg' => ':message',
            'errors' => ':errors',
            'code' => ':code',
            'debug' => ':debug'
        ]);

        // https://github.com/laravel/ideas/issues/627
        // Configure logging to include files and line numbers
        $monolog = \Log::getMonolog();
        $introspection = new \Monolog\Processor\IntrospectionProcessor(
            \Monolog\Logger::WARNING, // whatever level you want this processor to handle
            [
                'Monolog\\',
                'Illuminate\\',
            ]
        );
        $monolog->pushProcessor($introspection);
    }
}
