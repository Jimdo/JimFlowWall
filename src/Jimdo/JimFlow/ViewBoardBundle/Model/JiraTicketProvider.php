<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketFactory;

class JiraTicketProvider implements TicketProviderInterface {

    const CODE_STARTS_WITH = 'J';
    private $ticketFactory;

    public function __construct(TicketFactory $ticketFactory)
    {
        $this->ticketFactory = $ticketFactory;

    }

    public function getTicketByCode($code)
    {
        //todo
        $id = intval(str_replace(self::CODE_STARTS_WITH, '', $code));

        $ticket = $this->ticketFactory->build();

        $title = 'My Title';
        $type = 'My Type';
        $url = '#';
        
        $ticket->setTitle($title);
        $ticket->setId($id);
        $ticket->setType($type);
        $ticket->setUrl($url);

        return $ticket;
    }
    
    public function setTicketStatusByCodeAndStatus($code, $status, $newBoardColumn)
    {
        //todo
    }
}