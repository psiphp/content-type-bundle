<?php

namespace Psi\Bundle\ContentType\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private $storageLoaders = [];

    public function __construct(array $storageLoaders)
    {
        $this->storageLoaders = $storageLoaders;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('psi_content_type')
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('enabled_storage')
                    ->info('Enable these storage backends')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('storage')
                    ->addDefaultsIfNotSet()
                    ->children();

        foreach ($this->storageLoaders as $key => $storageLoader) {
            $storageNode = $node->arrayNode($key)
                ->addDefaultsIfNotSet()
                ->children();
            $storageLoader->configure($storageNode);
        }

        return $treeBuilder;
    }
}
