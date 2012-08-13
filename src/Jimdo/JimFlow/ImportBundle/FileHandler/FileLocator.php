<?php

namespace Jimdo\JimFlow\ImportBundle\FileHandler;

use \Jimdo\JimFlow\ImportBundle\Exception\NoMatchingFileException;


class FileLocator
{
    private $finder;

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
