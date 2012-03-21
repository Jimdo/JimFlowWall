<?php

namespace Jimdo\JimKanWall\ImportBundle\FileLocator;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorFile;
use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;


class FileLocator
{
    private $finder;
    private $file;

    public function __construct(\Symfony\Component\Finder\Finder $finder) {
        $this->finder = $finder;
    }

    public function getOldestFile($directory)
    {
        $files = $this->finder->files()->in($directory)->name('*.json')->sortByName()->getIterator();

        $importFile = $files->current();

        if(!isset($importFile)) {
           throw new NoMatchingFileException('No matching file for import found.');
        }
        return $importFile;
    }
}
