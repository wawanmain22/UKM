<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mailjet\Client;

class MailjetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('mailjet', function ($app) {
            return new Client(
                env('MJ_APIKEY_PUBLIC'),
                env('MJ_APIKEY_PRIVATE'),
                true,
                ['version' => 'v3.1']
            );
        });
    }
} 