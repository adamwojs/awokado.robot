<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider;

use AdamWojs\AwokadoRobot\Menu\Menu;

interface MenuProviderInterface
{
    public function getCurrentMenu(): ?Menu;
}
