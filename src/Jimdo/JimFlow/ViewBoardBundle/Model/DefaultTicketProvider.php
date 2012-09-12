<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketFactory;

class DefaultTicketProvider implements TicketProviderInterface {

    private $ticketFactory;

    public function __construct(TicketFactory $ticketFactory)
    {
        $this->ticketFactory = $ticketFactory;
    }

    public function getTicketByCode($code)
    {
        $id = $code;

        $ticket = $this->ticketFactory->build();

        $ticket->setId($id);
        $ticket->setUrl('#');

        return $ticket;
    }
    
    public function setTicketStatusByCodeAndStatus($code, $status)
    {
        //todo
    }
}