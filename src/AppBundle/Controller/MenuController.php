<?php
/**
 * Created by PhpStorm.
 * User: martynas
 * Date: 17.4.12
 * Time: 12.41
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    /**
     * @Route("/menu", name="menupage")
     */
    public function IndexAction ()
    {
        return $this->render('AppBundle::menu.html.twig', []);
    }

}