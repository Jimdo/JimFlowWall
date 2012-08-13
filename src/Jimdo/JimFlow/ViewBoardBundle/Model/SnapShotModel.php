<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;
 
class SnapShotModel {

    private $board;
    private $createdAt;

    public function __construct()
    {
    }

    public function setBoard($board)
    {
        $this->board = $board;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
