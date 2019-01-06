<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider;

use AdamWojs\AwokadoRobot\Menu\Menu;

interface MenuProviderInterface
{
    /**
     * @return Menu|null
     */
    public function getCurrentMenu(): ?Menu;

    /**
     * @return string
     */
    public function getRestaurant(): string;
}
