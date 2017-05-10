<?php
/**
 * Created by PhpStorm.
 * User: martynas
 * Date: 17.4.30
 * Time: 09.14
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoadController extends Controller
{

    /**
     * @Route("/load",name="loadpage")
     */
    public function IndexAction () {
        return $this->render('AppBundle::load.html.twig', []);
    }

}