<?php

namespace Psi\Bundle\ContentType\Example\src;

use Psi\Component\ContentType\FieldInterface;
use Psi\Component\ContentType\OptionsResolver\FieldOptionsResolver;
use Psi\Component\ContentType\Storage\ConfiguredType;
use Psi\Component\ContentType\Storage\TypeFactory;
use Psi\Component\ContentType\View\ScalarView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Psi\Component\ContentType\Standard\Storage\StringType;

class ExampleField implements FieldInterface
{
    /**
     * {@inheritdoc}
     */
    public function getViewType(): string
    {
        return ScalarView::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormType(): string
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageType(): string
    {
        return StringType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(FieldOptionsResolver $options)
    {
        $options->setDefaults([
            'foobar' => 'barfoo',
            'barbar' => 'booboo',
        ]);
        $options->setRequired('darf');
    }
}
