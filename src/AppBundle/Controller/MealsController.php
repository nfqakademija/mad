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
     * Gets JSON meals by calories and days
     * @Route("/getMeals", name="get_meals")
     * @return JsonResponse
     */
    public function getMealsAction()
    {
        $mealService = $this->get('app.meals_service');
        $meals = $mealService->getMealsByCaloriesAndDays();

        return new JsonResponse($meals);
    }

    /**
     * Gets JSON single Meal info
     * @Route("/getMeal", name="get_meal")
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
     * Gets JSON meals list by name for search field
     * @param string $name
     * @Route("/searchMeals/{name}", name="search_meals")
     * @return JsonResponse
     */
    public function getMealsByNameAction($name) {
        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(Meals::class)->getMealsByName($name);

        return new JsonResponse($meals);
    }

    /**
     * Gets JSON meals ingredients for ingredients cart
     * @Route("/getMealIngredients", name="get_meal_ingredients")
     * @return JsonResponse
     */
    public function getMealIngredientsAction() {
        $mealService = $this->get('app.meal_ingredients_service');
        $meals = $mealService->getIngredientsByMeals();

        return new JsonResponse($meals);
    }


}
