<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom',
                ]
            ])
            ->add('nationality', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nationalité',
                ]
            ])
            ->add('code', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Code',
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Slug',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
