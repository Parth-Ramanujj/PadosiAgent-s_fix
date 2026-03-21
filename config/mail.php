<?php

$mailEnv = static function (string $key, $default = null) {
    $value = env($key, $default);

    if (is_string($value)) {
        $value = trim($value);
        $hasDoubleQuotes = strlen($value) >= 2 && $value[0] === '"' && $value[strlen($value) - 1] === '"';
        $hasSingleQuotes = strlen($value) >= 2 && $value[0] === "'" && $value[strlen($value) - 1] === "'";

        if ($hasDoubleQuotes || $hasSingleQuotes) {
            $value = substr($value, 1, -1);
        }
    }

    return $value;
};

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'default' => $mailEnv('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => $mailEnv('MAIL_SCHEME'),
            'url' => $mailEnv('MAIL_URL'),
            'host' => $mailEnv('MAIL_HOST', '127.0.0.1'),
            'port' => (int) $mailEnv('MAIL_PORT', 587),
            'username' => $mailEnv('MAIL_USERNAME'),
            'password' => $mailEnv('MAIL_PASSWORD'),
            'timeout' => (int) $mailEnv('MAIL_TIMEOUT', 12),
            'local_domain' => $mailEnv('MAIL_EHLO_DOMAIN', parse_url((string) $mailEnv('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'mailtrap' => [
            'transport' => 'mailtrap',
            'token' => env('MAILTRAP_API_TOKEN'),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        'address' => $mailEnv('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => $mailEnv('MAIL_FROM_NAME', 'Example'),
    ],

];
