<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Bundle\ContentType\Tests\Functional\BaseTestCase;
use Symfony\Cmf\Component\ContentType\Field\TextField;
use Symfony\Cmf\Component\ContentType\Mapping\ScalarMapping;
use Symfony\Cmf\Component\ContentType\Mapping\StringMapping;

class ScalarMappingTest extends BaseTestCase
{
    public function testScalarMapping()
    {
        $registry  = $this->getContainer()->get('psi_content_type.registry.mapping');
        $mapping  = $registry->get('string');
        $this->assertInstanceOf(StringMapping::class, $mapping);
    }
}
