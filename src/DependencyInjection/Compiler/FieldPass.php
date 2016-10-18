<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class FieldPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'psi_content_type.field_registry',
            'psi_content_type.field'
        );
    }
}
