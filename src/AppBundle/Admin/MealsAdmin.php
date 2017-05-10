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
            ->add('name', 'text', array('label' => 'Pavadinimas'))
            ->add('weight', 'integer', array('label' => 'Svoris'))
            ->add('about', 'textarea', array('label' => 'Apie'))
            ->add('howtomake', 'textarea', array('label' => 'Kaip pasigaminti ?'))
            ->add('ingredients', 'sonata_type_collection',
                array('by_reference' => false, 'label' => 'Ingridientai'),
                array('edit'=>'inline','inline'=>'table')
            );
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array('label' => 'Pavadinimas'))
            //->add('name')
            ->add('weight', null, array('label' => 'Svoris'))
            ->add('about', null, array('label' => 'Apie patiekala'))
            ->add('howtomake', null, array('label' => 'Kaip pasigaminti?'))
            ->add('ingredients', null, array('label' => 'Ingridientai'))
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Pasirinkimai'
            ));;
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
