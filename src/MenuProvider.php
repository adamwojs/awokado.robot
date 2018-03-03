<?php

namespace AdamWojs\AwokadoRobot;

use DateTime;
use DateTimeInterface;
use Goutte\Client;

class MenuProvider implements MenuProviderInterface
{
    const AWOKADO_MENU_SELECTOR = '.tabcontent';

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
        $today = new DateTime();

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
            $line = trim($line);
            if (!$line) {
                continue;
            }

            list($name, $price) = explode(' – ', $line);
            $items[] = new MenuItem($name, $price);
        }

        return $items;
    }

    private function isMenuAvailable(DateTimeInterface $date): bool
    {
        return $date->format('N') <= 5;
    }
}
