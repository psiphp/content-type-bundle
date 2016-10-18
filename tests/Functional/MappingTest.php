<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Component\ContentType\Standard\Storage\StringType;

class MappingTest extends BaseTestCase
{
    public function testScalarMapping()
    {
        $registry = $this->getContainer()->get('psi_content_type.storage.type_registry');
        $type = $registry->get('string');
        $this->assertInstanceOf(StringType::class, $type);
    }
}
