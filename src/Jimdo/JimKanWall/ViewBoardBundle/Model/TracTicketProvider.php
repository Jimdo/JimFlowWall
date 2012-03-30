<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimKanWall\ViewBoardBundle\Model\TicketFactory;

class TracTicketProvider implements TicketProviderInterface {

    const CODE_STARTS_WITH = 'T';
    private $ticketFactory;
    private $xmlRpcClient;
    private $tracUrl;



    public function __construct(TicketFactory $ticketFactory, $xmlRpcClient, $tracUrl)
    {
        $this->ticketFactory = $ticketFactory;
        $this->xmlRpcClient = $xmlRpcClient;
        $this->tracUrl = $tracUrl;
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
        $ticket->setUrl(sprintf('https://%s/trac/ticket/%s', $this->tracUrl, $id));

        return $ticket;
    }
}