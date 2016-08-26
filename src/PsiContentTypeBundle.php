<?php

namespace Psi\Bundle\ContentType;

use Psi\Bundle\ContentType\DependencyInjection\Compiler\FieldPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\FormExtensionPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\MappingPass;
use Psi\Bundle\ContentType\DependencyInjection\Compiler\ViewPass;
use Psi\Bundle\ContentType\DependencyInjection\Storage\PhpcrOdmLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PsiContentTypeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $extension = $container->getExtension('psi_content_type');
        $extension->addStorageLoader('doctrine_phpcr_odm', new PhpcrOdmLoader($container));

        $container->addCompilerPass(new FieldPass());
        $container->addCompilerPass(new ViewPass());
        $container->addCompilerPass(new MappingPass());
        $container->addCompilerPass(new FormExtensionPass());
    }
}
