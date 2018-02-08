<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', textType::class, [
                'required' => true,
                'label' => 'Titre'
            ])
            ->add('content', textType::class, [
                'required' => true,
                'label' => 'Contenu'
            ])
            ->add('photo', textType::class, [
                'required' => false,
                'label' => 'Photo'
            ])
            ->add('publishedAt', DateTimeType::class, [
                'required' => true,
                'label' => 'Publié le'
            ])
            ->add('published', ChoiceType::class, [
            'choices' => ['oui' => 1, 'non' => 0],
            'expanded' => true,
            'label' => 'Publié'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_article_type';
    }
}
