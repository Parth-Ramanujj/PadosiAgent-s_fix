<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL "key too long" error
        Schema::defaultStringLength(191);

        // Register Mailtrap Transport Bridge
        try {
            if (class_exists(\Symfony\Component\Mailer\Bridge\Mailtrap\Transport\MailtrapTransportFactory::class)) {
                \Illuminate\Support\Facades\Mail::extend('mailtrap', function (array $config) {
                    $factory = new \Symfony\Component\Mailer\Bridge\Mailtrap\Transport\MailtrapTransportFactory(
                        null,
                        \Symfony\Component\HttpClient\HttpClient::create()
                    );

                    return $factory->create(new \Symfony\Component\Mailer\Transport\Dsn(
                        'mailtrap+sandbox',
                        'default',
                        $config['token'] ?? config('services.mailtrap.token'),
                        null,
                        null,
                        ['inboxId' => 4344034]
                    ));
                });
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to register Mailtrap bridge: ' . $e->getMessage());
        }
    }
}
