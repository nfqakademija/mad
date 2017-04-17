<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => 'Vardas'
        ));
        $builder->add('lname', TextType::class, array(
            'label' => 'Pavardė'
        ));
        $builder->add('weight', TextType::class, array(
            'label' => 'Svoris', 'attr' => array(
                'placeholder' => 'kg')
        ));
        $builder->add('height', TextType::class, array(
            'label' => 'Ūgis', 'attr' => array(
                'placeholder' => 'cm')
        ));
        $builder->add('activity', ChoiceType::class, array(
        'choices'  => array(
            'Pasyvus 0 val.' => 1,
            'Lengvai aktyvus 1-2 val.' => 2,
            'Vidutiniškai aktyvus 2-3 val.' => 3,
            'Labai aktyvus 3-5 val.' => 3,
            'Ypač aktyvus 5+ val.' => 4,
        ), 'choices_as_values' => true,'multiple'=>false,'expanded'=>true,
        'label' => 'Fizinis aktyvumas per savaitę',
         ));
        $builder->remove('b_food');
        $builder->remove('username');

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}