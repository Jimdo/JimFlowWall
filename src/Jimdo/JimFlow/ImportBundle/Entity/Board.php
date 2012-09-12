<?php

namespace Jimdo\JimFlow\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimFlow\ImportBundle\Entity\Board
 */
class Board
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var ArrayCollection $boardColumns
     */
    private $boardColumns;

    /**
     * @var ArrayCollection $boardSnapShots
     */
    private $boardSnapShots;

     /**
     * @var boolean $track
     */
    private $track;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get track
     *
     * @return boolean 
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * Set track
     *
     * @param boolean $track
     */
    public function setTrack($track)
    {
        $this->track = $track;
    }    
    
    /**
     * add boardColumn
     *
     * @param Jimdo\JimFlow\ImportBundle\Entity\BoardColumn $boardColumn
     */
    public function addBoardColumn($boardColumn)
    {
        $this->boardColums[] = $boardColumn;
    }

    /**
     *
     *
     * @param $boardColumns
     */

    public function setBoardColumns($boardColumns)
    {
        foreach ($boardColumns as $boardColumn) {
            $boardColumn->setBoard($this);
        }

        $this->boardColumns = $boardColumns;
    }

    /**
     * Get boardColumns
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getBoardColumns()
    {
        return $this->boardColumns;
    }

    /**
     * add boardSnapShot
     *
     * @param Jimdo\JimFlow\ImportBundle\Entity\BoardSnapShot $boardSnapShot
     */
    public function addBoardSnapShot($boardSnapShot)
    {
        $this->boardSnapShots[] = $boardSnapShot;
    }

    /**
     * Get boardSnapShots
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getBoardSnapShots()
    {
        return $this->boardSnapShots;
    }
}