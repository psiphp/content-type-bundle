<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class FieldPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'psi_content_type.registry.field',
            'psi_content_type.field'
        );
    }
}
