<?php
/**
 * Created by PhpStorm.
 * User: martynas
 * Date: 17.4.12
 * Time: 13.39
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddRecipeController extends Controller
{
    /**
     * @Route("/add", name="addrecipepage")
     */
    public function IndexAction ()
    {
        $response = new JsonResponse(array('data' => 123));
        return $response;

    }

}