<?php

namespace Jimdo\JimFlow\ImportBundle\ImportRunner;

use \Jimdo\JimFlow\ImportBundle\FileHandler\FileLocator;
use \Jimdo\JimFlow\ImportBundle\FileHandler\FileLoader;
use \Jimdo\JimFlow\ImportBundle\Exception\NoMatchingFileException;
use \Jimdo\JimFlow\ImportBundle\TicketTrack\TicketTrack;

class ImportRunner
{
    private $fileLocator;
    private $fileLoader;
    private $jsonToTicketMapper;
    private $ticketTrack;

    public function __construct($fileLocator, $fileLoader, $jsonToTicketMapper, TicketTrack $ticketTrack) {
        $this->fileLocator = $fileLocator;
        $this->fileLoader = $fileLoader;
        $this->jsonToTicketMapper = $jsonToTicketMapper;
        $this->ticketTrack = $ticketTrack;
    }

    public function run($directory)
    {
        $importFile = $this->fileLocator->getOldestFile($directory);

        $jsonObject = $this->fileLoader->getContentAsJsonObject($importFile);

        $this->jsonToTicketMapper->run($jsonObject);
        
        $snapShotId = $this->jsonToTicketMapper->getSnapShotId();
        
        $this->ticketTrack->run($snapShotId);
    }
}
