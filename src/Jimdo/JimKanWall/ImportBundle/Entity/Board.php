<?php

namespace Jimdo\JimKanWall\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimKanWall\ImportBundle\Entity\Board
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
     * add boardColumn
     *
     * @param Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn $boardColumn
     */
    public function addBoardColumn($boardColumn)
    {
        $this->boardColums[] = $boardColumn;
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
     * @param Jimdo\JimKanWall\ImportBundle\Entity\BoardSnapShot $boardSnapShot
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