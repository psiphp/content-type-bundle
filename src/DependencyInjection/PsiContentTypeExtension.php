<?php

namespace Psi\Bundle\ContentType\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PsiContentTypeExtension extends Extension
{
    private $storageLoaders = [];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('psi_content_type.phpcr_namespace_prefix', 'cmfct');
        $container->setParameter('psi_content_type.phpcr_namespace_url', 'https://github.com/symfony-cmf/content-type');

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('metadata.xml');
        $loader->load('form.xml');
        $loader->load('services.xml');
        $loader->load('fields.xml');
        $loader->load('mappings.xml');
        $loader->load('views.xml');
        $loader->load('console.xml');

        $storages = $config['storage_drivers'];

        if (!$storages) {
            throw new \InvalidArgumentException(sprintf(
                'No storage drivers specified for content-type component. Specify at least one of: "%s"',
                implode('", "', array_keys($this->storageLoaders))
            ));
        }

        foreach ($storages as $storageName) {
            if (!isset($this->storageLoaders[$storageName])) {
                throw new \InvalidArgumentException(sprintf(
                    'Unknown storage "%s", known storages: "%s"',
                    $storageName,
                    implode('", "', array_keys($this->storageLoaders))
                ));
            }

            $this->storageLoaders[$storageName]($container);
        }
    }

    public function addStorageLoader($name, callable $loader)
    {
        $this->storageLoaders[$name] = $loader;
    }

    public function getAlias()
    {
        return 'psi_content_type';
    }
}
