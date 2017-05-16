<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Ingredients;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class IngredientsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Pavadinimas'))
            ->add('calories', null, array('label' => 'Kalorijų kiekis'))
            ->add('ammount', null, array('label' => 'Ingridiento kiekis (gramais)'))
            ->add('productCount', null, array('label' => 'Ingridiento kiekis (vientais)'))
            ->add('ammountType', 'choice', array('choices' => array(
                'vnt' =>'vnt',
                'g' =>'g',
                'l' => 'l'
                ),'label' => 'Ingridiento kiekio tipas '
                ))
            ->add('price', null, array('label' => 'Kaina (eurais)'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array('label' => 'Pavadinimas'))
            ->add('calories', null, array('label' => 'Kalorijų kiekis'))
            ->add('ammount', null, array('label' => 'Ingridiento kiekis (gramais)'))
            ->add('productCount', null, array('label' => 'Ingridiento kiekis (vienetais)'))
            ->add('ammountType', null, array('label' => 'Ingridiento kiekio tipas'))
            ->add('price', null, array('label' => 'Kaina (eurais)'))
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),'label' => 'Tvarkyti'
            ));
    }
}