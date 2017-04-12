<?php
/**
 * Created by PhpStorm.
 * User: martynas
 * Date: 17.4.12
 * Time: 13.47
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settingspage")
     */
    public function IndexAction ()
    {
        return $this->render('AppBundle::settings.html.twig', []);
    }

}