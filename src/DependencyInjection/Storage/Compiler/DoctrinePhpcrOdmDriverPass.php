<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Storage\Compiler;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DoctrinePhpcrOdmDriverPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('doctrine_phpcr.odm.default_metadata_driver')) {
            return;
        }

        // add the driver for each document manager instance.
        foreach (array_keys($container->getParameter('doctrine_phpcr.odm.document_managers')) as $manager) {
            $this->addDriver($container, $manager);
        }
    }

    /**
     * Add the content-type driver to PHPCR-ODM, assuming that the ChainDriver
     * is being used.
     */
    private function addDriver(ContainerBuilder $container, $managerName)
    {
        $driverDef = $container->getDefinition(sprintf('doctrine_phpcr.odm.%s_metadata_driver', $managerName));
        $class = $container->getParameter(str_replace('%', '', $driverDef->getClass()));

        if ($class !== MappingDriverChain::class) {
            throw new \RuntimeException(sprintf(
                'Expected chain driver for manager "%s", got "%s"',
                $managerName,
                $driverDef->getClass()
            ));
        }

        $mappedNamespaces = $container->getParameter('psi_content_type.storage.doctrine_phpcr_odm.mapped_namespaces');

        foreach ($mappedNamespaces as $mappedNamespace) {
            $driverDef->addMethodCall('addDriver', [
                new Reference('psi_content_type.doctrine.phpcr_odm.field_driver'),
                $mappedNamespace,
            ]);
        }
    }
}
