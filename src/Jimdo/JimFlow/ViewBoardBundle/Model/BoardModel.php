<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;
 
class BoardModel
{
    private $name;
    private $columns;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addColumn($column)
    {
        $this->columns[] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }
    
}