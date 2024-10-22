<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\JsonFormatter;


class SlackLogger
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        $dateFormat = "Y-m-d H:i:s";
        $checkLocal = env('APP_ENV');

        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof SlackWebhookHandler) {
                $output = "[$checkLocal]: %datetime% > %level_name% - %message% `%context% %extra%` :poop: \n";
                $formatter = new LineFormatter($output, $dateFormat);

                $handler->setFormatter($formatter);
                $handler->pushProcessor(function ($record) {

                    $record['extra']['client'] = env('APP_NAME');

                    return $record;
                });
            }
        }
    }
}
