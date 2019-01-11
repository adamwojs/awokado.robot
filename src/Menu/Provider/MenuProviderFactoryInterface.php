<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider;

interface MenuProviderFactoryInterface
{
    /**
     * @return MenuProviderInterface
     */
    public static function create(): MenuProviderInterface;
}
