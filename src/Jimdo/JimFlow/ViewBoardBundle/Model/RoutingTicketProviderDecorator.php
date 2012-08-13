<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\TracTicketProvider;

class RoutingTicketProviderDecorator implements TicketProviderInterface {

    private $tracTicketProvider;

    public function __construct(TracTicketProvider $tracTicketProvider)
    {
        $this->tracTicketProvider = $tracTicketProvider;
    }

    public function getTicketByCode($code)
    {
        return $this->tracTicketProvider->getTicketByCode($code);
    }
}