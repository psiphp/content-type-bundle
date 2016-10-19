<?php

namespace Psi\Bundle\ContentType\DependencyInjection\Compiler;

class StorageTypePass extends AbstractRegistryPass
{
    public function __construct()
    {
        parent::__construct(
            'psi_content_type.storage.type_registry',
            'psi_content_type.storage_type'
        );
    }
}
