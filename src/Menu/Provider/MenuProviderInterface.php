<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider;

use AdamWojs\AwokadoRobot\Menu\Menu;
use DateTimeInterface;

interface MenuProviderInterface
{
    /**
     * @param \DateTimeInterface $date
     * @return Menu|null
     */
    public function getMenu(DateTimeInterface $date): ?Menu;

    /**
     * @param \DateTimeInterface $date
     * @return bool
     */
    public function isMenuAvailable(DateTimeInterface $date): bool;

    /**
     * @return string
     */
    public function getRestaurant(): string;
}
