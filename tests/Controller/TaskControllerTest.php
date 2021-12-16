<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    use Login;

    public function setUp(): void
    {

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testDeleteTaskActionWhenConnected()
    {
        $client = static::createClient();
        $this->logIn($client);
        $client->request('POST', '/tasks/delete/2');
        self::assertResponseRedirects('/tasks', '302');
    }

    public function testListAction()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/tasks');
        $this->assertResponseStatusCodeSame(200);

    }


    public function testCreateActionWhenConneted()
    {
        $client = static::createClient();
        $this->logIn($client);
        $crawler = $client->request('POST', '/tasks/create');
        $form = $crawler->selectButton("Ajouter")->form();
        $form['task[title]'] = "titre";
        $form['task[content]'] = "jrzjoghjlrzg lijrbgjo zrgj ojrzgh ojzrbg mojzrgjzr gkojrz bglkjzrbg lkjzrbgkljz";
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful($message = 'Superbe ! La tâche a été bien été ajoutée.');
    }

    public function testEditActionWhenConnected()
    {
        $client = static::createClient();
        $this->logIn($client);
        $crawler = $client->request('POST', '/tasks/edit/2');
        $form = $crawler->selectButton("Modifier")->form();
        $form['task[title]'] = "titre";
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful($message = 'Superbe ! La tâche a bien été modifiée.
');

    }


    public function testEditActionWhenNoConnected()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/edit/2');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/tasks');
    }

    public function testDeleteTaskActionWhenNoConnected()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/delete/2');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');
    }

    public function testCreateActionWhenNoConneted()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/tasks/create');
        $form = $crawler->selectButton("Ajouter")->form();
        $form['task[title]'] = "titre";
        $form['task[content]'] = "jrzjoghjlrzg lijrbgjo zrgj ojrzgh ojzrbg mojzrgjzr gkojrz bglkjzrbg lkjzrbgkljz";
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful($message = 'Superbe ! La tâche a été bien été ajoutée.');
    }
}
