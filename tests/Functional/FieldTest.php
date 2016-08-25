<?php

namespace Symfony\Cmf\Bundle\ContentTypeBundle\Tests\Functional;

use Symfony\Cmf\Bundle\ContentTypeBundle\Tests\Functional\BaseTestCase;
use Symfony\Cmf\Component\ContentType\Field\TextField;

class FieldTest extends BaseTestCase
{
    public function testTextField()
    {
        $registry  = $this->getContainer()->get('cmf_content_type.registry.field');
        $textField = $registry->get('text');
        $this->assertInstanceOf(TextField::class, $textField);
    }
}
