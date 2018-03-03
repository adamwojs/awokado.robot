<?php

namespace AdamWojs\AwokadoRobot;

final class AwokadoRobot
{
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
    }

    public function run(): void
    {
        $menu = $this->menuProvider->getCurrentMenu();
        if (null !== $menu) {
            $this->transport->send($menu);
        }
    }
}
