<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Ingredients;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MealsWithIngredients extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('ingredientId', 'sonata_type_model_list', array(
                'required' => false, 'by_reference' => false, 'label' => 'Pavadinimas'
            ))
//            ->add('mealId', 'sonata_type_model_list', array(
//                'required' => false, 'by_reference' => false
//            ))
            ->add('ammount','integer', array('label' => 'Kiekis'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('name');
    }
}
