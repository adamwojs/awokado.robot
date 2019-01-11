<?php

namespace AdamWojs\AwokadoRobot\Tests\Menu\Awokado;

use AdamWojs\AwokadoRobot\Menu\Provider\Awokado\AwokadoMenuProvider;
use AdamWojs\AwokadoRobot\Menu\Provider\Awokado\AwokadoMenuProviderFactory;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use PHPUnit\Framework\TestCase;

class AwokadoMenuProviderFactoryTest extends TestCase
{
    public function testReturnAwokadoMenuProviderObject()
    {
        $this->assertInstanceOf(
            AwokadoMenuProvider::class,
            AwokadoMenuProviderFactory::create()
        );
    }

    public function testReturnMenuProviderInterface()
    {
        $menuProvider = AwokadoMenuProviderFactory::create();
        $this->assertTrue($menuProvider instanceof MenuProviderInterface);
    }
}
