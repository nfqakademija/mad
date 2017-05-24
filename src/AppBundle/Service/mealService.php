<?php

namespace AppBundle\Service;


use AppBundle\Entity\Meals;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class mealService
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
     * Gets Meals by calories, days and mealsPerDay
     * @return array
     */
    public function getMealsByCaloriesAndDays() {
        $mealsForSelectedDays = $blockedIngredients = [];

        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $daysCount = $request->query->get('days');
        $calories = $request->query->get('cal');
        $mealsPerDay = $request->query->get('mealTimes');

        $blockedIngredients = $request->query->get('blockedIngredients');
        if(empty($blockedIngredients)) {
            $blockedIngredients = ["test"];
        }

        $mealCalories = $calories / $daysCount;

        $meals = $this ->em->getRepository(Meals::class)->getMealsByCaloriesAndBlockedIngredients($mealCalories, $blockedIngredients);

        if(!empty($meals)) {
            for($i=0; $i < $daysCount; $i++) {
                shuffle($meals);
                $meals2 = array_slice($meals, 0, $mealsPerDay, true);
                $mealsForSelectedDays = array_merge($mealsForSelectedDays, $meals2);
            }
        } else {
            $mealsForSelectedDays = ['status' => 'empty'];
        }

        return $mealsForSelectedDays;
    }
}