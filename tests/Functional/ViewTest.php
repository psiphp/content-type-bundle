<?php

namespace Psi\Bundle\ContentType\Tests\Functional;

use Psi\Component\ContentType\Standard\View\ScalarType;

class ViewTest extends BaseTestCase
{
    public function testScalarView()
    {
        $registry = $this->getContainer()->get('psi_content_type.view.type_registry');
        $view = $registry->get(ScalarType::class);
        $this->assertInstanceOf(ScalarType::class, $view);
    }
}
