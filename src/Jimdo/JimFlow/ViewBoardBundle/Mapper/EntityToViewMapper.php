<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Mapper;

use \Doctrine\ORM\EntityManager;
use \Jimdo\JimFlow\ViewBoardBundle\Model\SnapShotModel;
use \Jimdo\JimFlow\ViewBoardBundle\Model\BoardModel;
use \Jimdo\JimFlow\ViewBoardBundle\Model\ColumnModelFactory;
use \Jimdo\JimFlow\ViewBoardBundle\Model\CachingTicketProviderDecorator;

class EntityToViewMapper
{

    private $em;
    private $snapShotModel;
    private $boardModel;
    private $columnFactory;
    private $cachingTicketProviderDecorator;

    public function __construct(EntityManager $em, SnapShotModel $snapShotModel, BoardModel $boardModel, ColumnModelFactory $columnFactory, CachingTicketProviderDecorator $cachingTicketProviderDecorator)
    {
        $this->em = $em;
        $this->snapShotModel = $snapShotModel;
        $this->boardModel = $boardModel;
        $this->columnFactory = $columnFactory;
        $this->cachingTicketProviderDecorator = $cachingTicketProviderDecorator;
    }

    public function getSnapShotDetail($boardId)
    {
        $newestSnapShot = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\SnapShot')->getNewestSnapShotByBoardId($boardId);
        $this->snapShotModel->setCreatedAt($newestSnapShot->getCreatedAt());

        $this->boardModel->setName($newestSnapShot->getBoard()->getName());

        $boardColumns = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\BoardColumn')->getFilledColumnsByBoardIdAndSnapshotIdOrderedAsc($boardId, $newestSnapShot->getId());

        foreach ($boardColumns as $boardColumn)
        {
            $column = $this->columnFactory->build($boardColumn->getName());
            foreach ($boardColumn->getTicketsToColumn() as $ticketToColumn)
            {
                $ticket = $this->cachingTicketProviderDecorator->getTicketByCode($ticketToColumn->getId());

                $last_changed_ticket = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn')->getLatestSnapshotWithChangeByTicketId($ticketToColumn->getId());

                if ($last_changed_ticket) {
                    $ticket->setLastChange($last_changed_ticket->getSnapShot()->getCreatedAt());
                }
                $column->addTicket($ticket);
            }
            $this->boardModel->addColumn($column);
        }

        $this->snapShotModel->setBoard($this->boardModel);

        return $this->snapShotModel;
    }

}
