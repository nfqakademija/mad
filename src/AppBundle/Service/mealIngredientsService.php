<?php

namespace AppBundle\Service;


use AppBundle\Entity\MealsWithIngredients;
use Doctrine\ORM\EntityManager;

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

        $array = ['1 Day' =>
            [
                'mealId' => 3,
                'multiplier' => 2
            ],
            [
                'mealId' => 4,
                'multiplier' => 2
            ]
        ];

        foreach($array as $meal) {
            $mealIngredients = $this->em
                ->getRepository(MealsWithIngredients::class)
                ->getMealIngredients($meal['mealId']);

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

}