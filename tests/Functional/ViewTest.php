<?php

namespace Psi\Bundle\ContentType\Tests\Functional;


use Symfony\Cmf\Component\ContentType\View\ScalarView;

class ViewTest extends BaseTestCase
{
    public function testScalarView()
    {
        $registry = $this->getContainer()->get('psi_content_type.registry.view');
        $view = $registry->get(ScalarView::class);
        $this->assertInstanceOf(ScalarView::class, $view);
    }
}
