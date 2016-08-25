<?php

namespace Symfony\Cmf\Component\ContentType\Tests\Functional;

use Symfony\Cmf\Component\ContentType\Example\app\AppKernel;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    private $container;

    protected function getContainer()
    {
        if ($this->container) {
            return $this->conatiner;
        }

        $kernel = new AppKernel('dev', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        return $container;
    }
}
