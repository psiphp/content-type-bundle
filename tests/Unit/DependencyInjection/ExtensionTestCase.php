<?php

namespace Psi\Bundle\ContentType\Tests\Unit\DependencyInjection;

use Psi\Bundle\ContentType\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ExtensionTestCase extends \PHPUnit_Framework_TestCase
{
    protected function getConfig(array $loaders = [], array $config = [])
    {
        $configuration = new Configuration($loaders);

        $processor = new Processor();

        return $processor->processConfiguration($configuration, [$config]);
    }
}
