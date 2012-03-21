<?php

namespace Jimdo\JimKanWall\ImportBundle\FileLocator;

use \Symfony\Component\Finder\Finder;

class FileLocator
{
    private $finder;

    public function __construct($finder) {
        $this->finder = $finder;
    }

    public function getOldestFile($directory)
    {
        $files = $this->finder->files()->in($directory)->name('*.json')->sortByName()->getIterator();
        
        return $files->current();
    }
}
