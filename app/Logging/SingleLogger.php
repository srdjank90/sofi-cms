<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class SingleLogger
{
    /**
     * Customize the given logger instance.
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                "[%datetime%]  " . env('APP_NAME') . " %channel%.%level_name%: %message% %context% %extra%\n",
                null,
                true,
                true
            ));
        }
    }
}
