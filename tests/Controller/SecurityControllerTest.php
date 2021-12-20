<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
use Login;
    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['login_form[userName]'] = "user0";
        $form['login_form[password]'] = "bibi";
        $client->submit($form);
        self::assertResponseRedirects('/tasks', '302');

    }
}
