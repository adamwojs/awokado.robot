<?php

namespace AdamWojs\AwokadoRobot\Notification;

use AdamWojs\AwokadoRobot\Menu;

interface TransportInterface
{
    public function send(Menu $menu): void;
}
