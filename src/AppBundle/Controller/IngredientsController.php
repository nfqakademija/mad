<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ingredients;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class IngredientsController extends Controller
{
    /**
     * @Route("/getIngredients",  name="get_ingredients")
     * @return JsonResponse array
     */
    public function getIngredientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ingredients = $em->getRepository(Ingredients::class)->getIngredients();

        return new JsonResponse($ingredients);
    }

}
