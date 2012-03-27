<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketModel;

class TracTicketProvider implements TicketProviderInterface {

    const CODE_STARTS_WITH = 'T';
    private $ticket;

    public function __construct(TicketModel $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getTicketByCode($code)
    {
        $this->ticket->setTitle('lala');
        $this->ticket->setId('11111');
        $this->ticket->setType('type');

        return $this->ticket;
    }
}