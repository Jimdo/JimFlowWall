<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

interface TicketProviderInterface {

    public function getTicketByCode($code);
}
