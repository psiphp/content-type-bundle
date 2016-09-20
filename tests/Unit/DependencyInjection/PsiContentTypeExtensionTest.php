<?php

namespace Psi\Bundle\ContentType\Tests\Unit\DependencyInjection;

use Psi\Bundle\ContentType\DependencyInjection\PsiContentTypeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PsiContentTypeExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->extension = new PsiContentTypeExtension();
        $this->containerBuilder = $this->prophesize(ContainerBuilder::class);
    }

    /**
     * It should throw an Exception if an unknown storage type is specified.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown storage "foobar", known storages: "barfoo"
     */
    public function testUnknownStorageType()
    {
        $this->extension->addStorageLoader('barfoo', function () {
        });
        $this->extension->load([['storage_drivers' => ['foobar']]], $this->containerBuilder->reveal());
    }

    /**
     * It should throw an exception if NO storage drivers are specified.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage No storage drivers specified for content-type component. Specify at least one of: "barfoo"
     */
    public function testNoStorage()
    {
        $this->extension->addStorageLoader('barfoo', function () {
        });
        $this->extension->load([['storage_drivers' => []]], $this->containerBuilder->reveal());
    }
}
