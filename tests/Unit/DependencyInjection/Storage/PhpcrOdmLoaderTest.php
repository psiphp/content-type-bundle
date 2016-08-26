<?php

namespace Psi\Bundle\ContentType\Tests\Unit\DependencyInjection\Storage;

use Psi\Bundle\ContentType\DependencyInjection\Storage\PhpcrOdmLoader;
use Psi\Bundle\ContentType\Tests\Unit\DependencyInjection\ExtensionTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PhpcrOdmLoaderTest extends ExtensionTestCase
{
    private $loader;

    public function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->loader = new PhpcrOdmLoader($this->container);
    }

    /**
     * It should load the container.
     */
    public function testLoad()
    {
        $config = $this->getConfig(['foo' => $this->loader], []);
        $this->loader->load($config['storage']['foo']);
    }
}
