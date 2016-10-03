<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;

abstract class AbstractRegistryPass implements CompilerPassInterface
{
    private $registryId;
    private $serviceTag;
    private $registerByAlias;

    public function __construct(
        $registryId,
        $serviceTag,
        $registerByAlias = true
    ) {
        $this->registryId = $registryId;
        $this->serviceTag = $serviceTag;
        $this->registerByAlias = $registerByAlias;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->has($this->registryId)) {
            return;
        }

        $taggedIds = $container->findTaggedServiceIds($this->serviceTag);
        $registryDef = $container->getDefinition($this->registryId);

        foreach ($taggedIds as $serviceId => $attributes) {
            var_dump($serviceId);
            $attributes = $attributes[0];

            if ($this->registerByAlias) {
                if (!isset($attributes['alias'])) {
                    throw new InvalidArgumentException(sprintf(
                        $this->context . ' "%s" has no "alias" attribute in its tag',
                        $serviceId
                    ));
                }

                $alias = $attributes['alias'];
            } else {
                $alias = $container->getDefinition($serviceId)->getClass();
            }

            $registryDef->addMethodCall('register', [$alias, new Reference($serviceId)]);
        }
    }
}
