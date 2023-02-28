<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Session\DatabaseSessionHandler;

class SessionServiceProvider extends ServiceProvider
{
public function boot()
    {
        $this->app->session->extend('app.database', function ($app) {

            $connection_name = $this->app->config->get('session.connection');
            $connection      = $app->app->db->connection($connection_name);
            $table           = $this->app->config->get('session.table');
            $lifetime        = $this->app->config->get('session.lifetime');

            return new DatabaseSessionHandler($connection, $table, $lifetime, $this->app);
        });
    }
}
