<?php

namespace AdamWojs\AwokadoRobot;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory
{
    /**
     * @var Logger
     */
    private static $logger;

    /**
     * @return Logger
     * @throws \Exception
     */
    public static function get(): Logger
    {
        if (self::$logger) {
            return self::$logger;
        }

        $logger = new Logger('awokado-robot');
        $logger->pushHandler(new StreamHandler(__DIR__ . '../var/logs/awokado.log', Logger::DEBUG));
        self::$logger = $logger;

        return self::$logger;
    }
}
