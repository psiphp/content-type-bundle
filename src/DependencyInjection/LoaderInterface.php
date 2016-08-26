<?php

namespace Psi\Bundle\ContentType\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * The loader interface allows the registration of new dependency injection
 * "modules" at runtime. The loaders can add new configuration to the tree and
 * configure the DI container.
 *
 * This allows things with explicit 3rd-party dependencies to be selectively enabled.
 *
 * If the loader requires compiler passes, this can be achieved by passing the
 * container to the constructor at the point that the "loader" is registered (note
 * that any such compiler passes will always be added and should therefore not assume
 * the existence of the service which they act upon).
 */
interface LoaderInterface
{
    /**
     * Extend the bundle configuration. The given node
     * will be the child of an array node named after the loader
     * (e.g. doctrine-phpcr-odm).
     */
    public function configure(NodeBuilder $node);

    /**
     * Configure the container (which should be passed into the constructor).
     */
    public function load(array $config);
}
