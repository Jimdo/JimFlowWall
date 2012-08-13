<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\RoutingTicketProviderDecorator;


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