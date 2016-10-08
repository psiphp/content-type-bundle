<?php

namespace Psi\Bundle\ContentType\Example\src;

use Psi\Component\ContentType\FieldInterface;
use Psi\Component\ContentType\OptionsResolver\FieldOptionsResolver;
use Psi\Component\ContentType\Storage\Mapping\ConfiguredType;
use Psi\Component\ContentType\Storage\Mapping\TypeFactory;
use Psi\Component\ContentType\View\ScalarView;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    public function getStorageType(TypeFactory $factory): ConfiguredType
    {
        return $factory->create('object', [
            'class' => Image::class,
        ]);
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
