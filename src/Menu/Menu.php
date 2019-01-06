<?php

namespace AdamWojs\AwokadoRobot\Menu;

use DateTimeImmutable;

class Menu
{
    /** @var DateTimeImmutable */
    private $date;

    /** @var @var string */
    private $restaurant;

    /** @var MenuItem[] */
    private $items;

    /**
     * Menu constructor.
     *
     * @param string $restaurant
     * @param DateTimeImmutable $date
     * @param MenuItem[] $items
     */
    public function __construct(string $restaurant, DateTimeImmutable $date, array $items)
    {
        $this->restaurant = $restaurant;
        $this->date = $date;
        $this->items = $items;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
