<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimKanWall\ViewBoardBundle\Model\RoutingTicketProviderDecorator;


class CachingTicketProviderDecorator implements TicketProviderInterface {

    private $routingTicketProvidorDecorator;

    public function __construct(RoutingTicketProviderDecorator $routingTicketProvidorDecorator)
    {
        $this->routingTicketProvidorDecorator = $routingTicketProvidorDecorator;
    }

    public function getTicketByCode($code)
    {
        # ask cache
        if (!true) {

        }
        else
        {
            return $this->routingTicketProvidorDecorator->getTicketByCode($code);
        }
    }
}