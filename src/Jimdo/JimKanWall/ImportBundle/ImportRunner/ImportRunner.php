<?php

namespace Jimdo\JimKanWall\ImportBundle\ImportRunner;

use \Jimdo\JimKanWall\ImportBundle\FileHandler\FileLocator;
use \Jimdo\JimKanWall\ImportBundle\FileHandler\FileLoader;
use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;

class ImportRunner
{
    private $fileLocator;
    private $fileLoader;
    private $jsonToTicketMapper;

    public function __construct($fileLocator, $fileLoader, $jsonToTicketMapper) {
        $this->fileLocator = $fileLocator;
        $this->fileLoader = $fileLoader;
        $this->jsonToTicketMapper = $jsonToTicketMapper;
    }

    public function run($directory)
    {
        $importFile = $this->fileLocator->getOldestFile($directory);

        $jsonObject = $this->fileLoader->getContentAsJsonObject($importFile);

        $this->jsonToTicketMapper->run($jsonObject);


    }
}
