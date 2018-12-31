<?php

namespace AdamWojs\AwokadoRobot\Tests\Notification;

use AdamWojs\AwokadoRobot\Menu\Menu;
use AdamWojs\AwokadoRobot\Menu\MenuItem;
use AdamWojs\AwokadoRobot\Notification\SlackWebhookTransport;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\ClientInterface;

class SlackWebhookTransportTest extends TestCase
{
    const WEBHOOK_URL = 'https://hooks.slack.com/services/XYZ';

    /** @var SlackWebhookTransport */
    private $transport;

    /** @var ClientInterface|MockObject */
    private $client;

    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->transport = new SlackWebhookTransport($this->client, self::WEBHOOK_URL);
    }

    /**
     * @test
     */
    public function isSendingProperRequest()
    {
        $payload = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => "Menu na dziś (tj. 01-01-2018) :fork_and_knife:\n```\nA - 14,50 zł\nB - 12,50 zł\nC - 11,50 zł\n```",
            ],
        ];

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with('POST', self::WEBHOOK_URL, $payload);

        $menu = new Menu(new DateTimeImmutable('2018-01-01'), [
            new MenuItem('A', '14,50 zł'),
            new MenuItem('B', '12,50 zł'),
            new MenuItem('C', '11,50 zł'),
        ]);

        $this->transport->send($menu);
    }

    /**
     * @test
     * @expectedException \AdamWojs\AwokadoRobot\Notification\TransportException
     * @expectedExceptionMessage Notification transport error: Krem Buraczano-Chrzanowy detected!
     */
    public function isThrowingTransportExceptionOnFailure()
    {
        $exception = new \Exception('Krem Buraczano-Chrzanowy detected!');

        $this->client
            ->expects($this->once())
            ->method('request')
            ->willThrowException($exception);

        $this->transport->send($this->createMock(Menu::class));
    }
}
