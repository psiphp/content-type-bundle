<?php

namespace Symfony\Cmf\Bundle\ContentTypeBundle\Tests\Functional;

use Symfony\Cmf\Bundle\ContentTypeBundle\Tests\Functional\BaseTestCase;
use Symfony\Cmf\Component\ContentType\Field\TextField;
use Symfony\Cmf\Component\ContentType\View\ScalarView;

class ScalarViewTest extends BaseTestCase
{
    public function testScalarView()
    {
        $registry  = $this->getContainer()->get('cmf_content_type.registry.view');
        $view  = $registry->get(ScalarView::class);
        $this->assertInstanceOf(ScalarView::class, $view);
    }
}
