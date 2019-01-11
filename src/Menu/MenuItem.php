<?php

namespace AdamWojs\AwokadoRobot\Menu;

class MenuItem
{
    /** @var string */
    private $name;

    /** @var string */
    private $price;

    /**
     * MenuItem constructor.
     *
     * @param string $name
     * @param string $price
     */
    public function __construct(string $name, string $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}
