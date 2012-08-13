<?php

namespace Jimdo\JimFlow\ImportBundle\Tests;

use \PHPUnit_Framework_TestCase;

use \TestDataBuilder_ObjectBuilder;
use \TestDataBuilder_StubBuilder;
use \TestDataBuilder_StubWithDefinedMethodsBuilder;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @param string $className
     * @return \TestDataBuilder_StubBuilder
     */
    public function aStub($className)
    {
        return new TestDataBuilder_StubBuilder($className, $this);
    }

    /**
     * @param string $className
     * @return \TestDataBuilder_StubWithDefinedMethodsBuilder
     */
    public function aStubWithDefinedMethods($className)
    {
        return new TestDataBuilder_StubWithDefinedMethodsBuilder($className, $this);
    }

    /**
     * @param string $class
     * @return TestDataBuilder_ObjectBuilder
     */
    public function anObject($class)
    {
        return new TestDataBuilder_ObjectBuilder($class);
    }

    /**
     * @param string $className
     * @param string[] $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockWithoutConstructor($className, $methods = array())
    {
        return $this->getMock($className, $methods, array(), '', false);
    }

}