<?php

namespace AdamWojs\AwokadoRobot\Menu;

use DateTimeImmutable;

class Menu
{
    /** @var DateTimeImmutable */
    private $date;

    /** @var MenuItem[] */
    private $items;

    /**
     * Menu constructor.
     *
     * @param DateTimeImmutable $date
     * @param MenuItem[] $items
     */
    public function __construct(DateTimeImmutable $date, array $items)
    {
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
}
