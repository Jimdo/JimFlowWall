<?php

namespace Jimdo\JimKanWall\ImportBundle\Tests\FileLocator;

use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocator;
use \Jimdo\JimKanWall\ImportBundle\Tests\TestCase;

class FileLocatorTest extends TestCase
{
    public function testGetReturnOldestFileShouldRunWithGivenParams()
    {
        $finderStub = $this->getMock('\Symfony\Component\Finder\Finder', array(
                                                      'in', 'name', 'files', 'sortByName', 'getIterator'
                                                 ), array(), '', FALSE);


        $iteratorStub = $this->getMock('\ArrayIterator', array(
                                                      'current'
                                                 ), array(), '', FALSE);

        $iteratorStub->expects($this->exactly(1))
                ->method('current');

        $finderStub->expects($this->exactly(1))
                ->method('in')
                ->will($this->returnValue($finderStub));

        $finderStub->expects($this->exactly(1))
                ->method('name')
                ->will($this->returnValue($finderStub));

        $finderStub->expects($this->exactly(1))
                ->method('files')
                ->will($this->returnValue($finderStub));

        $finderStub->expects($this->exactly(1))
                ->method('sortByName')
                ->will($this->returnValue($finderStub));

        $finderStub->expects($this->exactly(1))
                ->method('getIterator')
                ->will($this->returnValue($iteratorStub));

        $fileLocator = new FileLocator($finderStub);

        $fileLocator->getOldestFile('/klopfer');

    }


}
