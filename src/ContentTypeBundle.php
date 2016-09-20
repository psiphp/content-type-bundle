<?php

namespace Psi\Bundle\ContentType;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\MappingPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\ViewPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\FieldPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\FormExtensionPass;

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
