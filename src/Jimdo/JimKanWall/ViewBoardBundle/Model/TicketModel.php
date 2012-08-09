<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;


class TicketModel {

    private $id;
    private $title;
    private $type;
    private $url;
    private $last_change;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setLastChange($last_change)
    {
        $this->last_change = $last_change;
    }

    public function getLastChange()
    {
        return $this->last_change;
    }
}
