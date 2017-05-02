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
            ->add('name', 'text', array('label' => 'Ingredient name'))
            ->add('calories')
            ->add('ammount')
            ->add('price');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('caloeries')
            ->add('ammount')
            ->add('price');
    }
}