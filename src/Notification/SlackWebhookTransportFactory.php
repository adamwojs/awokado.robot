<?php

namespace AdamWojs\AwokadoRobot\Notification;

use AdamWojs\AwokadoRobot\StackFactory;
use GuzzleHttp\Client;

class SlackWebhookTransportFactory
{
    /**
     * @param string $url
     * @return SlackWebhookTransport
     * @throws \Exception
     */
    public static function create(string $url): SlackWebhookTransport
    {
        $stack = StackFactory::create();

        return new SlackWebhookTransport(new Client([
            'handler' => $stack,
        ]), $url);
    }
}
