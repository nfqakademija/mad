<?php

namespace AppBundle\Service;


use AppBundle\Entity\MealsWithIngredients;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class mealIngredientsService
{
    private $em;

    /**
     * mealService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Gets ingredients array by meals
     * @return array
     */
    public function getIngredientsByMeals() {
        $allIngredients = [];
        $sortedIngredients = [];

        $array = $this->getRequestInfo();

        foreach($array as $meal) {
            $mealIngredients = $this->em
                ->getRepository(MealsWithIngredients::class)
                ->getMealIngredients($meal['id']);

            foreach($mealIngredients as $ingredient) {
                $ingredient['multiplier'] = $meal['multiplier'];
                array_push($allIngredients,$ingredient);
            }
        }

        $ingredientNames = [];

        foreach($allIngredients as $ingredient) {
            $ingredientAmount = 0;
            $ingredientProductCount = 0;

            if (!in_array($ingredient['name'], $ingredientNames)) {
                foreach ($allIngredients as $ingredient2) {
                    if ($ingredient['name'] == $ingredient2['name']) {
                        $ingredientAmount += $ingredient2['ammount'] * $ingredient['multiplier'];
                        $ingredientProductCount += $ingredient2['productCount'] * $ingredient['multiplier'];
                    }
                }

                array_push($sortedIngredients,
                    [
                        'name' => $ingredient['name'],
                        'amount' => $ingredientAmount,
                        'count' => $ingredientProductCount,
                        'type' => $ingredient['ammountType'],
                    ]
                );

                array_push($ingredientNames, $ingredient['name']);
            }
        }
        return $sortedIngredients;
    }


    /**
     * Gets Ajax request values
     * @return mixed
     */
    private function getRequestInfo() {
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $mealsWithUser = $request->query->get('doc');

        return $mealsWithUser;
    }

}