<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class ViewPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'psi_content_type.registry.view',
            'psi_content_type.view',
            false
        );
    }
}
