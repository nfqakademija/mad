<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IngredientsControllerTest extends WebTestCase
{
    public function testGetingredients()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getIngredients');
    }

}
