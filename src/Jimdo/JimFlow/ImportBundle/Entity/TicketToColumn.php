<?php

namespace Jimdo\JimFlow\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn
 */
class TicketToColumn
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Jimdo\JimFlow\ImportBundle\Entity\SnapShot $snapShot
     */
    private $snapShot;

    /**
     * @var Jimdo\JimFlow\ImportBundle\Entity\BoardColumn $boardColumn
     */
    private $boardColumn;

    /**
     * @var boolean $is_change
     */
    private $is_change = false;

    /**
     * Set id
     *
     * @param String $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
     * @param Jimdo\JimFlow\ImportBundle\Entity\SnapShot $snapShot
     */
    public function setSnapShot($snapShot)
    {
        $this->snapShot = $snapShot;
    }

    /**
     * Get snapShot
     *
     * @return Jimdo\JimFlow\ImportBundle\Entity\SnapShot
     */
    public function getSnapShot()
    {
        return $this->snapShot;
    }

    /**
     * Set boardColumn
     *
     * @param Jimdo\JimFlow\ImportBundle\Entity\BoardColumn $boardColumn
     */
    public function setBoardColumn($boardColumn)
    {
        $this->boardColumn = $boardColumn;
    }

    /**
     * Get boardColumn
     *
     * @return Jimdo\JimFlow\ImportBundle\Entity\BoardColumn
     */
    public function getBoardColumn()
    {
        return $this->boardColumn;
    }

    /**
     * Set is_change
     *
     * @param boolean $id
     */
    public function setIsChange($is_change)
    {
        $this->is_change = $is_change;
    }

    /**
     * Get is_change
     *
     * @return boolean
     */
    public function getIsChange()
    {
        return $this->is_change;
    }
}