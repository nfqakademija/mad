<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function showNavBarAction()
    {

        $user = $this->getUser();

        if($user) {
            $navBarInfo = '<li><a href="/userSchedules">Mano meniu</a></li>'
                .'<li><a href="/logout">Atsijungti</a></li>';
        } else {
            $navBarInfo = '<li><a href="/login">Prisijungti</a></li>';
        }

        return $this->render(
            '@App/index.html.twig',
            ['navBar' => $navBarInfo]
        );
    }


}
