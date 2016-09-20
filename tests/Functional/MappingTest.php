<?php

namespace Psi\Bundle\ContentType\Tests\Functional;


use Symfony\Cmf\Component\ContentType\Mapping\StringMapping;

class MappingTest extends BaseTestCase
{
    public function testScalarMapping()
    {
        $registry = $this->getContainer()->get('psi_content_type.registry.mapping');
        $mapping = $registry->get('string');
        $this->assertInstanceOf(StringMapping::class, $mapping);
    }
}
