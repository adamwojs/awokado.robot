<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider\ZieloneTarasy;

use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderFactoryInterface;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use AdamWojs\AwokadoRobot\StackFactory;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;

class ZieloneTarasyMenuProviderFactory implements MenuProviderFactoryInterface
{
    const URL = 'https://zielone-tarasy.eu';

    /**
     * @return ZieloneTarasyMenuProvider
     * @throws \Exception
     */
    public static function create(): MenuProviderInterface
    {
        $menuPage = self::getMenuPage();

        return new ZieloneTarasyMenuProvider($menuPage);
    }

    /**
     * @return Crawler
     * @throws \Exception
     */
    private static function getMenuPage(): Crawler
    {
        $stack = StackFactory::create();

        $goutteClient = new Client();
        $goutteClient->setClient(new GuzzleClient([
            'timeout' => 180,
            'handler' => $stack,
        ]));

        return $goutteClient->request('GET', self::URL);
    }
}
