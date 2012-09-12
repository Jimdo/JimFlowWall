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
    
    private function getTicketProvider($code)
    {
        switch($code[0]) {
            case 'T':
                $ticketProvider = $this->tracTicketProvider;
                break;
            case 'J':
                $ticketProvider = $this->jiraTicketProvider;
                break;
            default:
                $ticketProvider = $this->defaultTicketProvider;
        };
        return $ticketProvider;        
    }
    
    public function getTicketByCode($code)
    {
        $ticketProvider = $this->getTicketProvider($code);
        
        return $ticketProvider->getTicketByCode($code);
    }
    
    public function setTicketStatusByCodeAndStatus($code, $status)
    {
        $ticketProvider = $this->getTicketProvider($code);
        
        return $ticketProvider->setTicketStatusByCodeAndStatus($code, $status);
    }
}