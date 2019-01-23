<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider\ZieloneTarasy;

use AdamWojs\AwokadoRobot\Menu\Menu;
use AdamWojs\AwokadoRobot\Menu\MenuItem;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use DateTimeInterface;
use Symfony\Component\DomCrawler\Crawler;

class ZieloneTarasyMenuProvider implements MenuProviderInterface
{
    const MENU_CONTAINER_SELECTOR = '#comp-josrqp2g';

    /** @var Crawler */
    private $crawler;

    /**
     * ZieloneTarasyMenuProvider constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * {@inheritdoc}
     */
    public function getRestaurant(): string
    {
        return 'Zielone Tarasy Resto Bar Gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function isMenuAvailable(DateTimeInterface $date): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getMenu(DateTimeInterface $date): ?Menu
    {
        $lines = $this->parse();

        $header = null;
        $description = null;

        $menuItems = [];
        foreach($lines as $line) {
            if(strpos($line, 'zł:')) {
                if($header) {
                    $menuItems[] = $this->createMenuItem($header, $description);
                }

                $header = trim($line);
                $description = null;
            } else {
                $description .= $line;
            }
        }

        if($header){
            $menuItems[] = $this->createMenuItem($header, $description);
        }

        return new Menu(
            $this->getRestaurant(),
            $date,
            $menuItems
        );
    }

    /**
     * @return array
     */
    private function parse(): array
    {
        $children = $this
            ->crawler
            ->filter(self::MENU_CONTAINER_SELECTOR)
            ->children()
        ;

        $data = [];
        foreach ($children as $child) {
            $text = (string)$child->textContent;

            if (\strlen($text) > 2) {
                $data[] = $text;
            }
        }

        return $data;
    }

    /**
     * @param string $line1
     * @param string $line2
     * @return MenuItem
     */
    private function createMenuItem(string $line1, string $line2): MenuItem
    {
        list($meal, $price, $currency) = explode(' ', $line1);

        return new MenuItem(
            sprintf('%s: %s', $meal, $line2),
            $price
        );
    }
}
