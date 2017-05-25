<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIsuserloggedin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/isUserLoggedIn');
    }

}
