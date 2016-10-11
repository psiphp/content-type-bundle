<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Storage;

use Psi\Bundle\ContentType\DependencyInjection\LoaderInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

class PhpcrOdmLoader implements LoaderInterface
{
    private $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(NodeBuilder $node)
    {
        $node
            ->arrayNode('phpcr')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('namespace_prefix')
                        ->info('Prefix to use for content-type-managed documents')
                        ->defaultValue('cmfct')
                    ->end()
                    ->scalarNode('namespace_uri')
                        ->defaultValue('https://github.com/psiphp/content-type')
                    ->end()
                ->end()
            ->end()
            ->arrayNode('mapped_namespaces')
                ->info('Namespaces which should be mapped')
                ->prototype('scalar')->end()
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $config)
    {
        $prefix = 'psi_content_type.storage.doctrine_phpcr_odm.';
        $this->container->setParameter($prefix . 'namespace_prefix', $config['phpcr']['namespace_prefix']);
        $this->container->setParameter($prefix . 'namespace_uri', '');
        $this->container->setParameter($prefix . 'mapped_namespaces', $config['mapped_namespaces']);


        $loader = new Loader\XmlFileLoader($this->container, new FileLocator(__DIR__.'/../../Resources/config'));
        $loader->load('doctrine/phpcr-odm.xml');
    }
}
