<?php

namespace Jimdo\JimKanWall\ImportBundle\Tests\FileLocator;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorFile;
use \Jimdo\JimKanWall\ImportBundle\Tests\TestCase;

class FileLocatorFileTest extends TestCase
{
    public function testConstructorShouldSetNameAndDatetime()
    {
        $name = 'klopfer';
        $datetime = new \DateTime('@1331306743');

        $file = new FileLocatorFile($name, $datetime);

        $this->assertEquals($name, $file->getName());
        $this->assertEquals($datetime, $file->getCreatedAt());
    }
}
