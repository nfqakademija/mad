<?php

namespace AppBundle\Repository;

/**
 * MealWithIngredientsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MealWithIngredientsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMealIngredients($mealId) {
        return $this->createQueryBuilder('mi')
            ->leftJoin('mi.ingredientId', 'i')
            ->where('mi.mealId = :mealId')
            ->select('i.name, i.ammount, i.productCount, i.ammountType')
            ->setParameter('mealId', $mealId)->getQuery()->getArrayResult();
    }
}
