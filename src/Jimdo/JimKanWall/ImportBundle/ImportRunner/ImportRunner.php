<?php

namespace Jimdo\JimKanWall\ImportBundle\ImportRunner;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocator;
use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;
use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorFile;

class ImportRunner
{
    private $fileLocator;

    public function __construct($fileLocator) {
        $this->fileLocator = $fileLocator;
    }

    public function run($directory)
    {
        $importFile = $this->fileLocator->getOldestFile($directory);


        $string = file_get_contents($importFile);

        $jsonSnapShot = json_decode($string);
    }
}
