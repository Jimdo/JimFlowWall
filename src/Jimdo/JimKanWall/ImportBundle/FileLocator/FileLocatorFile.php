<?php

namespace Jimdo\JimKanWall\ImportBundle\FileLocator;

class FileLocatorFile
{
    private $name;
    private $created_at;

    public function __construct($name, $created_at) {
        $this->name = $name;
        $this->created_at = $created_at;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getName() {
        return $this->name;
    }
}
