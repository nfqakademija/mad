<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meals;
use AppBundle\Entity\MealsWithIngredients;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MealsController extends Controller
{
    /**
     * Gets JSON meals by selected calories count (name, and calories)
     * @Route("/getMeals")
     * @return JsonResponse
     */
    public function getMealsAction()
    {
        $mealsForSelectedDays = [];

        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $daysCount = $request->query->get('days');
        $calories = $request->query->get('cal');
        $mealsPerDay = $request->query->get('mealTimes');

        // array
        $blockedIngredients = $request->query->get('blockedIngredients');
        if(empty($blockedIngredients)) {
            $blockedIngredients = ["test"];
        }

        $mealCalories = $calories / $daysCount;

        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(Meals::class)->getMealsByCaloriesAndBlockedIngredients($mealCalories, $blockedIngredients);


        if(!empty($meals)) {
            for($i=0; $i < $daysCount; $i++) {
                shuffle($meals);
                $meals2 = array_slice($meals, 0, $mealsPerDay, true);
                $mealsForSelectedDays = array_merge($mealsForSelectedDays, $meals2);
            }
        } else {
            $mealsForSelectedDays = ['status' => 'empty'];
        }

        return new JsonResponse($mealsForSelectedDays);
    }

    /**
     * Gets JSON single Meal info
     * @Route("/getMeal")
     * @return JsonResponse
     */
    public function getMealAction()
    {
        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $meal = $em->getRepository(Meals::class)->getMealInfo($id);

        return new JsonResponse($meal);
    }

    /**
     * Gets meals list by name for search field
     * @param string $name
     * @Route("/searchMeals/{name}")
     * @return JsonResponse
     */
    public function getMealsByNameAction($name) {
        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(Meals::class)->getMealsByName($name);

        return new JsonResponse($meals);
    }

    /**
     * Gets meals list by name for search field
     * @Route("/getMealIngredients")
     * @return JsonResponse
     */
    public function getMealIngredients() {
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
            $em = $this->getDoctrine()->getManager();
            $mealIngredients = $em->getRepository(MealsWithIngredients::class)->getMealIngredients($meal['mealId']);

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
        return new JsonResponse($sortedIngredients);
    }


}
