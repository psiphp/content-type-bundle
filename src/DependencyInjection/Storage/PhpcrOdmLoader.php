<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Storage;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class PhpcrOdmLoader
{
    public function __invoke(ContainerBuilder $container)
    {
        $container->setParameter('psi_content_type.phpcr_namespace_prefix', 'cmfct');
        $container->setParameter('psi_content_type.phpcr_namespace_url', 'https://github.com/symfony-cmf/content-type');

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config'));
        $loader->load('doctrine/phpcr-odm.xml');
    }
}
