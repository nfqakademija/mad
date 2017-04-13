<?php
/**
 * Created by PhpStorm.
 * User: martynas
 * Date: 17.4.12
 * Time: 11.01
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/main", name="mainpage")
     */
    public function IndexAction ()
    {
        return $this->render('AppBundle::main.html.twig', []);
    }

}