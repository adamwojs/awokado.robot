<?php

namespace AdamWojs\AwokadoRobot\Notification;

use AdamWojs\AwokadoRobot\Menu\Menu;

interface TransportInterface
{
    public function send(Menu $menu): void;
}
