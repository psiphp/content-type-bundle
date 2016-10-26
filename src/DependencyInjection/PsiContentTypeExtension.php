<?php

namespace Psi\Bundle\ContentType\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PsiContentTypeExtension extends Extension
{
    private $storageLoaders = [];

    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($this->storageLoaders);
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('metadata.xml');
        $loader->load('form.xml');
        $loader->load('services.xml');
        $loader->load('fields.xml');
        $loader->load('storage-types.xml');
        $loader->load('views.xml');
        $loader->load('console.xml');

        $storages = $config['enabled_storage'];

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

            $this->storageLoaders[$storageName]->load($config['storage'][$storageName]);
        }
    }

    public function addStorageLoader($name, LoaderInterface $loader)
    {
        $this->storageLoaders[$name] = $loader;
    }

    public function getAlias()
    {
        return 'psi_content_type';
    }
}
