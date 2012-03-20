<?php

namespace Jimdo\JimKanWall\ImportBundle\Tests\FileLocator;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocator;
use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorDirectory;
use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorFile;
use \Jimdo\JimKanWall\ImportBundle\Tests\TestCase;

class FileLocatorTest extends TestCase
{
    public function testItShouldReturnAFile()
    {
        $fileLocator = new FileLocator(array('json'));

        $file = $this->aFile()->build();

        $directory = $this->aStub('\Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorDirectory')->with('getFiles', array($file))->build();

        $this->assertEquals($file, $fileLocator->getOldestFile($directory));
    }

    public function testItShouldReturnTheOldestFile()
    {
        $fileLocator = new FileLocator(array('json'));

        $aFile = $this->aFile('@1331306743')->build();
        $bFile = $this->aFile('@1331306741')->build();
        $cFile = $this->aFile('@1331306745')->build();

        $files = array($aFile, $bFile, $cFile);

        $directory = $this->aStub('\Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorDirectory')->with('getFiles', $files)->build();

        $this->assertEquals(date_format($bFile->getCreatedAt(), 'U'), date_format($fileLocator->getOldestFile($directory)->getCreatedAt(), 'U'));
    }

    private function aFile($timestamp = '@1331306742')
    {
        return $this->aStub('\Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocatorFile')->with('getCreatedAt', new \DateTime($timestamp));
    }

}
