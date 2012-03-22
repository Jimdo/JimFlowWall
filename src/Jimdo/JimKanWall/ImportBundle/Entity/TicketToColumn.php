<?php

namespace Jimdo\JimKanWall\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimKanWall\ImportBundle\Entity\TicketToColumn
 */
class TicketToColumn
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Jimdo\JimKanWall\ImportBundle\Entity\SnapShot $snapShot
     */
    private $snapShot;

    /**
     * @var Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn $boardColumn
     */
    private $boardColumn;

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
     * Set snapShot
     *
     * @param Jimdo\JimKanWall\ImportBundle\Entity\SnapShot $snapShot
     */
    public function setSnapShot($snapShot)
    {
        $this->snapShot = $snapShot;
    }

    /**
     * Get snapShot
     *
     * @return Jimdo\JimKanWall\ImportBundle\Entity\SnapShot
     */
    public function getSnapShot()
    {
        return $this->snapShot;
    }

    /**
     * Set boardColumn
     *
     * @param Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn $boardColumn
     */
    public function setBoardColumn($boardColumn)
    {
        $this->boardColumn = $boardColumn;
    }

    /**
     * Get boardColumn
     *
     * @return Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn
     */
    public function getBoardColumn()
    {
        return $this->boardColumn;
    }
}