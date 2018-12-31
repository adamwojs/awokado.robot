<?php

namespace AdamWojs\AwokadoRobot;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;

class StackFactory
{
    /**
     * @return HandlerStack
     * @throws \Exception
     */
    public static function create(): HandlerStack
    {
        $logger = LoggerFactory::get();

        $stack = HandlerStack::create();
        $stack->push(Middleware::log($logger, new MessageFormatter('{request} - {response}')));

        return $stack;
    }
}
