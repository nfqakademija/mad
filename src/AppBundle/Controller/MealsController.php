<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meals;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $daysCount = $request->query->get('days');
        $calories = $request->query->get('cal');
        $mealsPerDay = $request->query->get('mealTimes');

        $mealCalories = $calories / $daysCount;
        $mealsCount = $daysCount * $mealsPerDay;

        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(Meals::class)->getMealsByCalories($mealCalories);

        shuffle($meals);

        if(!empty($meals)) {
            $meals = array_slice($meals, 0, $mealsCount, true);
        } else {
            $meals = ['status' => 'empty'];
        }

        return new JsonResponse(json_encode($meals));
    }

    /**
     * Gets JSON single Meal info
     * @param $id
     * @Route("/getMeal/{id}")
     * @return JsonResponse
     */
    public function getMealAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $meal = $em->getRepository(Meals::class)->getMealInfo($id);

        return new JsonResponse(json_encode($meal));
    }

    /**
     * Gets meals list by name for search field
     * @param string $name
     * @Route("/searchMeals/{name}")
     * @return JsonResponse
     */
    public function getMealsByNameAction($name) {
        echo $name;
        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(Meals::class)->getMealsByName($name);

        return new JsonResponse(json_encode($meals));
    }
}