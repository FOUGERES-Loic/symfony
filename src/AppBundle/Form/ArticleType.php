<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('menu', EntityType::class, [
                'class' => 'AppBundle:Menu',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'choice_label' => function ($menu) {
                    return $menu->getTitle();
                }])
            ->add('content', textType::class, [
                'required' => true,
                'label' => 'Contenu'
            ])
            ->add('photo', FileType::class, [
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
            ])
            ->add('linkedto', EntityType::class, [
            'class' => 'AppBundle:Article',
            'multiple' => true,
            'required' => false,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c');
            },
            'choice_label' => function ($article) {
                return $article->getTitle();
            }]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_article_type';
    }
}
