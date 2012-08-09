<?php

namespace Jimdo\JimKanWall\ImportBundle\Mapper;

use \Jimdo\JimKanWall\ImportBundle\Entity\SnapShot;
use \Jimdo\JimKanWall\ImportBundle\Entity\Board;
use DateTime;
use \Jimdo\JimKanWall\ImportBundle\Entity\BoardColumnRepository;
use \Jimdo\JimKanWall\ImportBundle\Entity\TicketToColumn;

class JsonToTicketMapper
{
    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function run($jsonObject) {

        $snapShot = $this->generateSnaphot($jsonObject);
        $this->generateTickets($jsonObject, $snapShot);
    }

    public function generateSnaphot($jsonObject) {

        $board_id = $jsonObject->board->info->board_id;
        $dateTimeCreated = $jsonObject->board->info->date;

        $snapShot = new SnapShot();
        $snapShot->setBoard($this->em->getReference('\Jimdo\JimKanWall\ImportBundle\Entity\Board',$board_id));
        $snapShot->setCreatedAt(new DateTime($dateTimeCreated));

        $this->em->persist($snapShot);
        $this->em->flush();

        return $snapShot;
    }

    public function generateTickets($jsonObject, $snapShot) {
        $boardColumns = $this->em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn')->getColumnsByBoardIdOrderedAsc($snapShot->getBoard()->getId());

        foreach($jsonObject->board->informations as $information) {
            $ticket = new TicketToColumn();
            $ticket->setSnapShot($snapShot);
            $ticket->setId($information->data);
            $ticket->setBoardColumn($boardColumns[$information->column]);

            $last_ticket_to_column = $this->em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\TicketToColumn')->getLatestTicketToColumnByTicketId($ticket->getId());

            if (!$last_ticket_to_column || $last_ticket_to_column->getBoardColumn()->getID() != $boardColumns[$information->column]->getId()) {

                $ticket->setIsChange(true);
            }
            $this->em->persist($ticket);
        }

        $this->em->flush();
    }

}
