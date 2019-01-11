<?php

namespace AdamWojs\AwokadoRobot\Menu\Provider\Awokado;

use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderFactoryInterface;
use AdamWojs\AwokadoRobot\Menu\Provider\MenuProviderInterface;
use AdamWojs\AwokadoRobot\StackFactory;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class AwokadoMenuProviderFactory implements MenuProviderFactoryInterface
{
    /**
     * @return AwokadoMenuProvider
     * @throws \Exception
     */
    public static function create(): MenuProviderInterface
    {
        $stack = StackFactory::create();

        $goutteClient = new Client();
        $goutteClient->setClient(new GuzzleClient([
            'timeout' => 180,
            'handler' => $stack,
        ]));

        return new AwokadoMenuProvider($goutteClient, 'http://awokado.krakow.pl/lunch-bar/menu/');
    }
}
