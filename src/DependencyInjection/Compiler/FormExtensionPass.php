<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class FormExtensionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('form.registry')) {
            return;
        }

        $registryDef = $container->getDefinition('form.registry');
        $extensions = $registryDef->getArgument(0);
        $extensions[] = new Reference('cmf_content_type.form.extension.field');
    }
}
