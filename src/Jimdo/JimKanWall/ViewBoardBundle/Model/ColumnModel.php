<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;
 
class ColumnModel {

    private $name;
    private $tickets;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addTicket($ticket)
    {
        $this->tickets[] = $ticket;
    }

    public function getTickets()
    {
        return $this->tickets;
    }

    public function getName()
    {
        return $this->name;
    }
}
