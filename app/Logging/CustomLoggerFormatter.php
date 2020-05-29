<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomLoggerFormatter{
  /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                nl2br('[%datetime%] %channel%::%level_name%: %message% %context% %extra%\n')
            ));
            #$handler->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, ['Illuminate\']));
        }
    }
}
