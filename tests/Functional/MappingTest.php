<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Component\ContentType\Storage\Mapping\Type\StringType;

class MappingTest extends BaseTestCase
{
    public function testScalarMapping()
    {
        $registry = $this->getContainer()->get('psi_content_type.registry.storage_type');
        $type = $registry->get('string');
        $this->assertInstanceOf(StringType::class, $type);
    }
}
