<?php

namespace Jimdo\JimFlow\ImportBundle\ImportRunner;

use \Jimdo\JimFlow\ImportBundle\FileHandler\FileLocator;
use \Jimdo\JimFlow\ImportBundle\FileHandler\FileLoader;
use \Jimdo\JimFlow\ImportBundle\Exception\NoMatchingFileException;

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
