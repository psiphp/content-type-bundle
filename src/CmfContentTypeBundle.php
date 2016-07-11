<?php

namespace Symfony\Cmf\Bundle\ContentType;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sylius\Component\Registry\DependencyInjection\Compiler\AliasedServicePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CmfContentTypeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AliasedServicePass(
            'cmf_content_type.registry.field',
            'cmf_content_type.field'
        ));

        $container->addCompilerPass(new AliasedServicePass(
            'cmf_content_type.registry.view',
            'cmf_content_type.view'
        ));
    }
}
