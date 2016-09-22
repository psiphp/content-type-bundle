<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Component\ContentType\Field\TextField;

class FieldTest extends BaseTestCase
{
    public function testTextField()
    {
        $registry = $this->getContainer()->get('psi_content_type.registry.field');
        $textField = $registry->get('text');
        $this->assertInstanceOf(TextField::class, $textField);
    }
}
