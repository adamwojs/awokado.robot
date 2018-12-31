<?php

namespace AdamWojs\AwokadoRobot\Notification;

use AdamWojs\AwokadoRobot\Menu\Menu;
use GuzzleHttp\ClientInterface;

class SlackWebhookTransport implements TransportInterface
{
    /** @var ClientInterface */
    private $client;

    /** @var string */
    private $webhookUrl;

    /**
     * SlackNotificationSender constructor.
     *
     * @param ClientInterface $client
     * @param string $webhookUrl
     */
    public function __construct(ClientInterface $client, string $webhookUrl)
    {
        $this->client = $client;
        $this->webhookUrl = $webhookUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Menu $menu): void
    {
        $text = $this->formatMenu($menu);

        try {
            $this->client->request('POST', $this->webhookUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'text' => $text,
                ],
            ]);
        } catch (\Exception $e) {
            throw new TransportException('Notification transport error: ' . $e->getMessage(), 0, $e);
        }
    }

    private function formatMenu(Menu $menu): string
    {
        $lines = [];
        $lines[] = sprintf('Menu na dziś (tj. %s) :fork_and_knife:', $menu->getDate()->format('d-m-Y'));
        $lines[] = '```';
        foreach ($menu->getItems() as $item) {
            $lines[] = sprintf('%s - %s', $item->getName(), $item->getPrice());
        }
        $lines[] = '```';

        return implode(PHP_EOL, $lines);
    }
}
