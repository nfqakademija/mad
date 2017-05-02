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
                'required' => false, 'by_reference' => false
            ))
//            ->add('mealId', 'sonata_type_model_list', array(
//                'required' => false, 'by_reference' => false
//            ))
            ->add('ammount','integer');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

    }
}
