<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketModel;

class TicketFactory {

    public function build()
    {
        return new TicketModel();
    }
}
