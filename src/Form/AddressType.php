<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de votre adresse',
                'attr' => [
                    'placeholder' => 'Nommer votre adresse.'
                ],
                'required' => true
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom.'
                ],
                'required' => true
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom.'
                ],
                'required' => true
            ])
            ->add('company', TextType::class, [
                'label' => 'Votre société',
                'attr' => [
                    'placeholder' => '(Facultatif) Nombre de votre société.'
                ],
                'required' => false
            ])
            ->add('address', TextType::class, [
                'label' => 'Entrez votre adresse',
                'attr' => [
                    'placeholder' => 'Ex: 8 Rue de l\'hirondelle'
                ],
                'required' => true
            ])
            ->add('postal', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ],
                'required' => true
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'attr' => [
                    'placeholder' => 'Ex: Paris'
                ],
                'required' => true
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                'attr' => [
                    'placeholder' => 'Ex: France'
                ],
                'required' => true
            ])
            ->add('phone', TelType::class, [
                'label' => 'Votre téléphone:',
                'attr' => [
                    'placeholder' => 'Ex: 0685749654'
                ],
                'required' => true
            ])
            ->add('submit', SubmitType::class, ['label' => 'Valider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
