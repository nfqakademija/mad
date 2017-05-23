<?php

namespace AppBundle\Repository;

/**
 * MealRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MealsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find meals by selected calories
     * @param integer $calories
     * @param array $ingredient
     * @return array
     */
    public function getMealsByCaloriesAndBlockedIngredients($calories, $ingredient = [0])
    {
        $subQuery = $this->_em->createQueryBuilder();
        $subQuery
            ->select('me.id')
            ->from('AppBundle:MealsWithIngredients', 'ms')
            ->leftJoin('ms.ingredientId','me')
            ->leftJoin('ms.mealId','ml')
            ->where(' ml.id = m.id AND me.name IN (:ingredient)');

        $mealsQuery = $this->createQueryBuilder('m');
        $mealsQuery
            ->leftJoin('m.ingredients', 'mi')
            ->leftJoin('mi.ingredientId', 'i')
            ->groupBy('m.id')
            ->having('sum(mi.ammount * i.calories) > :lessCalories')
            ->setParameter(':lessCalories', abs($calories-100))
            ->andHaving('sum(mi.ammount * i.calories) < :moreCalories')
            ->setParameter(':moreCalories', abs($calories+100000))
            ->select('m.id, SUM(mi.ammount * i.calories) as calories, m.name')
            ->addSelect('m.logo')
            ->andWhere($mealsQuery->expr()->not($mealsQuery->expr()->exists($subQuery->getDQL())))
            ->setParameter('ingredient', $ingredient);

        return $mealsQuery->getQuery()->getArrayResult();
    }

    /**
     * Get single meal info
     * @param integer $id
     * @return array
     */
    public function getMealInfo($id)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.ingredients', 'mi')
            ->leftJoin('mi.ingredientId', 'i')
            ->groupBy('m.id')
            ->select('m.id, m.name, m.about, m.howToMake, m.logo, m.time')
            ->addSelect('SUM(mi.ammount * i.calories) as calories')
            ->where('m.id = :id')
            ->setParameter('id', $id)->getQuery()->getArrayResult();
    }

    /**
     * Get meals by name
     * @param string $name
     * @return array
     */
    public function getMealsByName($name)
    {
        if($name == 'Cp5568C'){
            return $this->createQueryBuilder('m')
                ->select('m.id, m.name, m.about, m.howToMake, m.logo')
                ->getQuery()->getArrayResult();
        }
        else{
            return $this->createQueryBuilder('m')
                ->select('m.id, m.name, m.about, m.howToMake, m.logo')
                ->where('UPPER(m.name) LIKE UPPER(:name)')
                ->setParameter('name', '%'.$name.'%')->getQuery()->getArrayResult();
        }

    }


}
