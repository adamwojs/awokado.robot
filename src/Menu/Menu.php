<?php

namespace AdamWojs\AwokadoRobot\Menu;

use DateTimeInterface;

class Menu
{
    /** @var DateTimeInterface */
    private $date;

    /** @var @var string */
    private $restaurant;

    /** @var MenuItem[] */
    private $items;

    /**
     * Menu constructor.
     *
     * @param string $restaurant
     * @param DateTimeInterface $date
     * @param MenuItem[] $items
     */
    public function __construct(string $restaurant, DateTimeInterface $date, array $items)
    {
        $this->restaurant = $restaurant;
        $this->date = $date;
        $this->items = $items;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return MenuItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getRestaurant(): string
    {
        return $this->restaurant;
    }
}
