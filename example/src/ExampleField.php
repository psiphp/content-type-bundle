<?php

namespace Psi\Bundle\ContentType\Example\src;

use Psi\Component\ContentType\FieldInterface;
use Psi\Component\ContentType\MappingBuilder;
use Psi\Component\ContentType\View\ScalarView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExampleField implements FieldInterface
{
    /**
     * {@inheritdoc}
     */
    public function getViewType()
    {
        return ScalarView::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormType()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getMapping(MappingBuilder $builder)
    {
        return $builder->compound(Image::class)
            ->map('image', 'string')
            ->map('mimeType', 'string')
            ->map('originalFilename', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $options)
    {
        $options->setDefaults([
            'foobar' => 'barfoo',
            'barbar' => 'booboo',
        ]);
    }
}
