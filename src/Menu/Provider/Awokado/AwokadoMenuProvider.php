<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider\Awokado;

use AdamWojs\AwokadoRobot\Menu\Menu;
use AdamWojs\AwokadoRobot\Menu\MenuItem;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use DateTimeImmutable;
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
    public function getCurrentMenu(): ?Menu
    {
        $today = new DateTimeImmutable();

        if (!$this->isMenuAvailable($today)) {
            // Menu is not available
            return null;
        }

        $items = $this->parseMenu($this->fetchMenu($today));

        return new Menu($today, $items);
    }

    private function fetchMenu(DateTimeInterface $date): string
    {
        return $this->client
            ->request('GET', $this->websiteUrl)
            ->filter(self::AWOKADO_MENU_SELECTOR)
            ->eq($date->format('N'))
            ->text();
    }

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

    private function isMenuAvailable(DateTimeInterface $date): bool
    {
        return $date->format('N') <= 5;
    }
}
