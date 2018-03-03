<?php

namespace AdamWojs\AwokadoRobot;

interface MenuProviderInterface
{
    public function getCurrentMenu(): ?Menu;
}
