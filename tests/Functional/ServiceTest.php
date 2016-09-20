<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

class ServiceTest extends BaseTestCase
{
    public function testServices()
    {
        $container = $this->getContainer();

        foreach ($container->getServiceIds() as $serviceId) {
            if (0 === strpos($serviceId, 'cmf_content_type')) {
                $container->get($serviceId);
            }
        }
    }
}
