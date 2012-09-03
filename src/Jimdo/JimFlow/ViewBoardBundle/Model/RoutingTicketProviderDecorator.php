<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\TracTicketProvider;
use \Jimdo\JimFlow\ViewBoardBundle\Model\DefaultTicketProvider;
use \Jimdo\JimFlow\ViewBoardBundle\Model\JiraTicketProvider;

class RoutingTicketProviderDecorator implements TicketProviderInterface {

    private $tracTicketProvider;
    private $defaultTicketProvider;
    private $jiraTicketProvider;

    public function __construct(TracTicketProvider $tracTicketProvider, DefaultTicketProvider $defaultTicketProvider, JiraTicketProvider $jiraTicketProvider)
    {
        $this->tracTicketProvider = $tracTicketProvider;
        $this->defaultTicketProvider = $defaultTicketProvider;
        $this->jiraTicketProvider = $jiraTicketProvider;
    }

    public function getTicketByCode($code)
    {
        $ticket = null;
        switch($code[0]) {
            case 'T':
                $ticket = $this->tracTicketProvider->getTicketByCode($code);
                break;
            case 'J':
                $ticket = $this->jiraTicketProvider->getTicketByCode($code);
                break;
            default:
                $ticket = $this->defaultTicketProvider->getTicketByCode($code);
        };
        return $ticket;
    }
}