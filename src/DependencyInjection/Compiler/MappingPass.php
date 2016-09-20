<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class MappingPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'cmf_content_type.registry.mapping',
            'cmf_content_type.mapping'
        );
    }
}
