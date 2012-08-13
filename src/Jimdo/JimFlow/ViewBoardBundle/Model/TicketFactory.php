<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketModel;

class TicketFactory {

    public function build()
    {
        return new TicketModel();
    }
}
