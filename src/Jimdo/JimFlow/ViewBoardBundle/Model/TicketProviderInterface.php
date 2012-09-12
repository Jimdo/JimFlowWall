<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

interface TicketProviderInterface {

    public function getTicketByCode($code);
    
    public function setTicketStatusByCodeAndStatus($code, $status);
}
