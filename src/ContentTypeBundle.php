<?php

namespace Symfony\Cmf\Bundle\ContentTypeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler\MappingPass;
use Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler\ViewPass;
use Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler\FieldPass;
use Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler\FormExtensionPass;

class ContentTypeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FieldPass());
        $container->addCompilerPass(new ViewPass());
        $container->addCompilerPass(new MappingPass());
        $container->addCompilerPass(new FormExtensionPass());
    }
}
