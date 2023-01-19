<?php

namespace App\Providers;

use App\Interfaces\PostRepositryInterface;
use App\Repositries\PostRepositry;
use App\Interfaces\CommentRepositryInterface;
use App\Repositries\CommentRepositry;
use Illuminate\Support\ServiceProvider;

class RepositryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepositryInterface::class, PostRepositry::class);
        $this->app->bind(CommentRepositryInterface::class, CommentRepositry::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
