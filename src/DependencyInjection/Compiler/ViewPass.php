<?php

namespace Symfony\Cmf\Bundle\ContentTypeBundle\DependencyInjection\Compiler;

class ViewPass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'cmf_content_type.registry.view',
            'cmf_content_type.view',
            false
        );
    }
}
