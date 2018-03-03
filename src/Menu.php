<?php

namespace AdamWojs\AwokadoRobot;

use DateTimeInterface;

class Menu
{
    /** @var DateTimeInterface */
    private $date;

    /** @var MenuItem[] */
    private $items;

    /**
     * Menu constructor.
     *
     * @param DateTimeInterface $date
     * @param MenuItem[] $items
     */
    public function __construct(DateTimeInterface $date, array $items)
    {
        $this->date = $date;
        $this->items = $items;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
