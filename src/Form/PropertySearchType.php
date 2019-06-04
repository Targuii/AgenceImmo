<?php

namespace App\Form;

use App\Entity\Options;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface',RangeType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'min' => 10,
                    'max' => 400,
                    'step' => 10,
                    'class' => 'custom-range',
                    'oninput' => 'document.getElementById("fSurface").innerHTML = this.value'
                ]
            ])
            ->add('maxPrice',RangeType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 500000,
                    'step' => 1000,
                    //'value' => 500000,
                    'class' => 'custom-range',
                    'oninput' => 'document.getElementById("fPrice").innerHTML = this.value'
                ]
            ])
            ->add('options',EntityType::class,[
                'required' => false,
                //'label' => false,
                'class' => Options::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('distance',RangeType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'min' => 5,
                    'max' => 1000,
                    'step' => 10,
                    //'value' => 1000,
                    'class' => 'custom-range',
                    'oninput' => 'document.getElementById("fDist").innerHTML = this.value'
                ]
            ])
            ->add('address',null,[
                //'label' => false,
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
