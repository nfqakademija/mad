<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Checks if user is logged in
     * @Route("/isUserLoggedIn")
     *
     * @return Response
     */
    public function isUserLoggedInAction()
    {
        $user = $this->getUser();

        if($user) {
            $loggedIn = 1;
        } else {
            $loggedIn = 0;
        }

        return new Response($loggedIn);
    }

}
