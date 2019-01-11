<?php

namespace AdamWojs\AwokadoRobot\Tests;

use AdamWojs\AwokadoRobot\LoggerFactory;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LoggerFactoryTest extends TestCase
{
    public function testReturnLoggerObject()
    {
        $this->assertInstanceOf(
            Logger::class,
            LoggerFactory::get()
        );
    }

    public function testAlwaysReturnTheSameInstance()
    {
        $this->assertSame(
            LoggerFactory::get(),
            LoggerFactory::get()
        );
    }
}
