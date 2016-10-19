<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

class ServiceTest extends BaseTestCase
{
    public function testServices()
    {
        $container = $this->getContainer();

        foreach ($container->getServiceIds() as $serviceId) {
            if (0 === strpos($serviceId, 'psi_content_type')) {
                $service = $container->get($serviceId);

                // for the sake of incrementing the assertion count...
                $this->assertNotNull($service);
            }
        }
    }
}
