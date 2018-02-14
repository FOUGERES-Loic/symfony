<?php

namespace AppBundle\Form;

use AppBundle\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
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
                    return $er->createQueryBuilder('c')
                        ->where('c.parent == null');
                },
                'choice_label' => function ($menu) {
                    return $menu->getTitle();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Menu::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_menu_type';
    }
}
