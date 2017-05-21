<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meals;
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
}
