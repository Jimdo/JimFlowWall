<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketFactory;

class TracTicketProvider implements TicketProviderInterface {

    const CODE_STARTS_WITH = 'T';
    private $ticketFactory;
    private $xml_rpc_client;

    public function __construct(TicketFactory $ticketFactory, $xmlRpcClient)
    {
        $this->ticketFactory = $ticketFactory;
        $this->xmlRpcClient = $xmlRpcClient;
    }

    public function getTicketByCode($code)
    {
        $id = intval(str_replace(self::CODE_STARTS_WITH, '', $code));

        $result = $this->xmlRpcClient->call('ticket.get', array($id));
        $title = $result[3]['summary'];
        $type = $result[3]['type'];

        $ticket = $this->ticketFactory->build();

        $ticket->setTitle($title);
        $ticket->setId($id);
        $ticket->setType($type);

        return $ticket;
    }
}