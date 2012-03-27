<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Model;

use ColumnModelu;

class ColumnModelFactory {

    public function build($name)
    {
        return new ColumnModel($name);
    }
}
