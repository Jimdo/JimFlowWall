<?php

namespace Jimdo\JimKanWall\ImportBundle\ImportRunner;

use \Jimdo\JimKanWall\ImportBundle\FileHandler\FileLocator;
use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;

class ImportRunner
{
    private $fileLocator;
    private $fileLoader;

    public function __construct($fileLocator, $fileLoader) {
        $this->fileLocator = $fileLocator;
        $this->fileLoader = $fileLoader;
    }

    public function run($directory)
    {
        $importFile = $this->fileLocator->getOldestFile($directory);

        $jsonContent = $this->fileLoader->getContentAsJsonObject($importFile);

        echo var_dump($jsonContent);
    }
}
