<?php

namespace Jimdo\JimKanWall\ImportBundle\FileLocator;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorDirectory;

class FileLocator
{
    private $filetypes;

    public function __construct($filetypes) {
        $this->filetypes = $filetypes;
    }

    public function getOldestFile($directory)
    {
        $files = $directory->getFiles($this->filetypes);

        usort($files, array('Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorDirectory', '_cmpDateTimeAsc'));

        return isset($files[0]) ? $files[0] : null;
    }
}
