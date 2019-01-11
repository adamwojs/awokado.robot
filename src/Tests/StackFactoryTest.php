<?php

namespace AdamWojs\AwokadoRobot\Tests;

use AdamWojs\AwokadoRobot\StackFactory;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class StackFactoryTest extends TestCase
{
    public function testReturnStackObject()
    {
        $this->assertInstanceOf(
            HandlerStack::class,
            StackFactory::create()
        );
    }
}
