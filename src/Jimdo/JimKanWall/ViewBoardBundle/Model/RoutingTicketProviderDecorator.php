<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimKanWall\ViewBoardBundle\Model\TracTicketProvider;

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