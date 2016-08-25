<?php

namespace Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler;

class FieldPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'cmf_content_type.registry.field',
            'cmf_content_type.field'
        );
    }
}
