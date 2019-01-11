<?php

namespace AdamWojs\AwokadoRobot\Tests\Menu\Awokado;

use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use AdamWojs\AwokadoRobot\Menu\Provider\ZieloneTarasy\ZieloneTarasyMenuProvider;
use AdamWojs\AwokadoRobot\Menu\Provider\ZieloneTarasy\ZieloneTarasyMenuProviderFactory;
use PHPUnit\Framework\TestCase;

class ZieloneTarasyMenuProviderFactoryTest extends TestCase
{
    public function testReturnZieloneTarasyMenuProviderObject()
    {
        $this->assertInstanceOf(
            ZieloneTarasyMenuProvider::class,
            ZieloneTarasyMenuProviderFactory::create()
        );
    }

    public function testReturnMenuProviderInterface()
    {
        $menuProvider = ZieloneTarasyMenuProviderFactory::create();
        $this->assertTrue($menuProvider instanceof MenuProviderInterface);
    }
}
