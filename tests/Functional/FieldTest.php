<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Component\ContentType\Standard\Field\TextField;

class FieldTest extends BaseTestCase
{
    public function testTextField()
    {
        $registry = $this->getContainer()->get('psi_content_type.field_registry');
        $textField = $registry->get('text');
        $this->assertInstanceOf(TextField::class, $textField);
    }
}
