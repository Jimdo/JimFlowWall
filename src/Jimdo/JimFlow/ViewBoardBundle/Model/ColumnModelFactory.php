<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use ColumnModelu;

class ColumnModelFactory {

    public function build($name)
    {
        return new ColumnModel($name);
    }
}
