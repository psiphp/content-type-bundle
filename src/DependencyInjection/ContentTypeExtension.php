<?php

namespace Psi\Bundle\ContentType\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ContentTypeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('cmf_content_type.phpcr_namespace_prefix', 'cmfct');
        $container->setParameter('cmf_content_type.phpcr_namespace_url', 'https://github.com/symfony-cmf/content-type');

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('metadata.xml');
        $loader->load('form.xml');
        $loader->load('services.xml');
        $loader->load('fields.xml');
        $loader->load('mappings.xml');
        $loader->load('views.xml');
        $loader->load('doctrine/phpcr-odm.xml');
    }
}
