<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class MappingPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'psi_content_type.registry.mapping',
            'psi_content_type.mapping'
        );
    }
}
