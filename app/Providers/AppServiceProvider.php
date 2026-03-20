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

                    // Check if we are on live or local
                    $isProduction = config('app.env') === 'production';
                    $scheme = $isProduction ? 'mailtrap+api' : 'mailtrap+sandbox';
                    
                    // Inbox ID is only required for Sandbox mode
                    $options = [];
                    if (!$isProduction) {
                        $options['inboxId'] = env('MAILTRAP_INBOX_ID', 4344034);
                    }

                    return $factory->create(new \Symfony\Component\Mailer\Transport\Dsn(
                        $scheme,
                        'default',
                        $config['token'] ?? config('services.mailtrap.token'),
                        null,
                        null,
                        $options
                    ));
                });
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to register Mailtrap bridge: ' . $e->getMessage());
        }
    }
}
