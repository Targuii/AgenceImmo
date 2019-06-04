<?php

namespace App\Form;

use App\Entity\Options;
use App\Entity\PropertySearch;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface minimum'
                ]
            ])
            ->add('maxPrice',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget Max'
                ]
            ])
            ->add('options',EntityType::class,[
                'required' => false,
                'label' => false,
                'class' => Options::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('distance',ChoiceType::class,[
                'label' => false,
                'required' => false,
                'choices' => [
                    '10 Km' => 10,
                    '1000 Km' => 1000
                ]
            ])
            ->add('address',null,[
                'label' => false,
                'required' => false
            ])
            ->add('lat',HiddenType::class)
            ->add('lng',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
