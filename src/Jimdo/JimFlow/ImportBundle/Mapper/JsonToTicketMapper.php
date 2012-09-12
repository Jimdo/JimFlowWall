<?php

namespace Jimdo\JimFlow\ImportBundle\Mapper;

use \Jimdo\JimFlow\ImportBundle\Entity\SnapShot;
use \Jimdo\JimFlow\ImportBundle\Entity\Board;
use DateTime;
use \Jimdo\JimFlow\ImportBundle\Entity\BoardColumnRepository;
use \Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn;

class JsonToTicketMapper
{
    private $em;
    private $snapShot;

    public function __construct($em) {
        $this->em = $em;
    }

    public function run($jsonObject) {

        $this->generateSnaphot($jsonObject);
        $this->generateTickets($jsonObject);
    }

    public function generateSnaphot($jsonObject) {

        $board_id = $jsonObject->board->info->board_id;
        $dateTimeCreated = $jsonObject->board->info->date;

        $snapShot = new SnapShot();
        $snapShot->setBoard($this->em->getReference('\Jimdo\JimFlow\ImportBundle\Entity\Board',$board_id));
        $snapShot->setCreatedAt(new DateTime($dateTimeCreated));

        $this->em->persist($snapShot);
        $this->em->flush();
        
        $this->snapShot = $snapShot;
    }

    public function generateTickets($jsonObject) {
        $boardColumns = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\BoardColumn')->getColumnsByBoardIdOrderedAsc($this->snapShot->getBoard()->getId());

        foreach($jsonObject->board->informations as $information) {
            $ticket = new TicketToColumn();
            $ticket->setSnapShot($this->snapShot);
            $ticket->setId($information->data);
            $ticket->setBoardColumn($boardColumns[$information->column]);

            $last_ticket_to_column = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn')->getLatestTicketToColumnByTicketId($ticket->getId());

            if (!$last_ticket_to_column || $last_ticket_to_column->getBoardColumn()->getID() != $boardColumns[$information->column]->getId()) {

                $ticket->setIsChange(true);
            }
            $this->em->persist($ticket);
        }

        $this->em->flush();
    }
    
    public function getSnapShotId()
    {
        return $this->snapShot->getId();
    }

}
