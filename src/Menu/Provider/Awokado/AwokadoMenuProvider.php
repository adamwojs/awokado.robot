<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider\Awokado;

use AdamWojs\AwokadoRobot\Menu\Menu;
use AdamWojs\AwokadoRobot\Menu\MenuItem;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use DateTimeInterface;
use Goutte\Client;

class AwokadoMenuProvider implements MenuProviderInterface
{
    const AWOKADO_MENU_SELECTOR = '.tabcontent';
    const SEPARATOR = ' – ';

    /** @var Client */
    private $client;

    /** @var string */
    private $websiteUrl;

    /**
     * MenuProvider constructor.
     *
     * @param Client $client
     * @param string $websiteUrl
     */
    public function __construct(Client $client, string $websiteUrl)
    {
        $this->client = $client;
        $this->websiteUrl = $websiteUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getRestaurant(): string
    {
        return 'Awokado Lunch Bar';
    }

    /**
     * {@inheritdoc}
     */
    public function isMenuAvailable(DateTimeInterface $date): bool
    {
        return $date->format('N') <= 5;
    }

    /**
     * {@inheritdoc}
     */
    public function getMenu(DateTimeInterface $date): ?Menu
    {
        if (!$this->isMenuAvailable($date)) {
            throw new \RuntimeException('Menu not available');
        }

        $items = $this->parseMenu($this->fetchMenu($date));

        return new Menu($this->getRestaurant(), $date, $items);
    }

    /**
     * @param DateTimeInterface $date
     * @return string
     */
    private function fetchMenu(DateTimeInterface $date): string
    {
        return $this->client
            ->request('GET', $this->websiteUrl)
            ->filter(self::AWOKADO_MENU_SELECTOR)
            ->eq($date->format('N'))
            ->text();
    }

    /**
     * @param string $text
     * @return array
     */
    private function parseMenu(string $text): array
    {
        $items = [];
        $lines = explode(PHP_EOL, $text);
        foreach ($lines as $line) {
            if (false !== ($pos = mb_stripos($line, self::SEPARATOR))) {
                $name = trim(mb_substr($line, 0, $pos));
                $price = trim(mb_substr($line, $pos + mb_strlen(self::SEPARATOR)));

                if ('' !== $name && '' !== $price) {
                    $items[] = new MenuItem($name, $price);
                }
            }
        }

        return $items;
    }
}
