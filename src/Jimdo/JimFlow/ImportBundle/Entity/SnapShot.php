<?php

namespace Jimdo\JimFlow\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimFlow\ImportBundle\Entity\SnapShot
 */
class SnapShot
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var datetime $createdAt
     */
    private $createdAt;

    /**
     * @var Jimdo\JimFlow\ImportBundle\Entity\Board $board
     */
    private $board;

    /**
     * @var ArrayCollection $ticketsInSnapShot
     */
    private $ticketsInSnapShot;

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set board
     *
     * @param Jimdo\JimFlow\ImportBundle\Entity\Board $board
     */
    public function setBoard($board)
    {
        $this->board = $board;
    }

    /**
     * Get board
     *
     * @return Jimdo\JimFlow\ImportBundle\Entity\Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * add ticketToColumn
     *
     * @param Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn $ticketToColumn
     */
    public function addBoardSnapShot($ticketToColumn)
    {
        $this->ticketsInSnapShot[] = $ticketToColumn;
    }

    /**
     * Get ticketInSnapShot
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTicketsInSnapShot()
    {
        return $this->ticketsInSnapShot;
    }
}