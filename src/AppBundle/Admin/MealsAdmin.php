<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Ingredients;
use AppBundle\Entity\Meals;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MealsAdmin extends AbstractAdmin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Meal name'))
            ->add('weight', 'integer')
            ->add('about', 'textarea')
            ->add('howtomake', 'textarea', array('label' => 'How to make ?'))
            ->add('ingredients', 'sonata_type_collection',
                array('by_reference' => false, 'label' => 'Ingredients'),
                array('edit'=>'inline','inline'=>'table')
            );
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('caloeries')
            ->add('ammount')
            ->add('price');
    }

    /**
     * @param Meals $obj
     */
    public function prePersist($obj)
    {
        $this->updateMealRelation($obj);
    }

    /**
     * @param Meals $obj
     */
    public function preUpdate($obj)
    {
        $this->updateMealRelation($obj);
    }

    /**
     * @param $obj
     */
    private function updateMealRelation(Meals $obj)
    {
        foreach ($obj->getIngredients() as $ingredient) {
            $ingredient->setMealId($obj);
        }
    }
}
