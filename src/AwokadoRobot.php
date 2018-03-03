<?php

namespace AdamWojs\AwokadoRobot;

use Exception;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

final class AwokadoRobot
{
    use LoggerAwareTrait;

    /** @var MenuProviderInterface */
    private $menuProvider;

    /** @var Notification\TransportInterface */
    private $transport;

    /**
     * AwokadoRobot constructor.
     *
     * @param MenuProviderInterface $menuProvider
     * @param Notification\TransportInterface $transport
     */
    public function __construct(MenuProviderInterface $menuProvider, Notification\TransportInterface $transport)
    {
        $this->menuProvider = $menuProvider;
        $this->transport = $transport;
        $this->logger = new NullLogger();
    }

    public function run(): void
    {
        try {
            $this->logger->info('Fetching menu...');

            $menu = $this->menuProvider->getCurrentMenu();
            if (null === $menu) {
                $this->logger->info('Menu is not available');

                return;
            }

            $this->logger->info('Sending menu...');
            $this->transport->send($menu);
            $this->logger->info('Menu has been sent.');
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
