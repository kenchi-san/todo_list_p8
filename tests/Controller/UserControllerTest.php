<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    use Login;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function setUp(): void
    {

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testlistUser()
    {

        $userRepository = $this->entityManager->getRepository(User::class);
        /**
         * @var UserRepository
         */
        $user = $userRepository->findAll();

        self::assertCount(6, $user);
    }

    public function testUrlListUserWhenNoConnected()
    {
        $client = static::createClient();
        $client->request('GET', 'admin/users');
        self::assertResponseRedirects('/login', '302');
    }


    public function testEditUser()
    {
        $client = static::createClient();
        $this->logIn($client);
        $crawler = $client->request('POST', '/admin/users/3/edit');
        $form = $crawler->selectButton("Modifier")->form();
        $form['user[userName]'] = "bibi";
        $form['user[email]'] = "bibi@gmail.com";
        $form['user[password][first]'] = 'bibi';
        $form['user[password][second]'] = 'bibi';
        $form['user[roles]']->select("ROLE_ADMIN");
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful($message = 'Superbe ! L\'utilisateur a bien été modifié');
    }

    public function testCreateUser()
    {
        $client = static::createClient();
        $this->logIn($client);
        $crawler = $client->request('POST', '/admin/users/create');
        $form = $crawler->selectButton("Ajouter")->form();

        $form['user[userName]'] = "bibi";
        $form['user[email]'] = "bibi@gmail.com";
        $form['user[password][first]'] = 'bibi';
        $form['user[password][second]'] = 'bibi';
        $form['user[roles]']->select("ROLE_USER");
        $client->submit($form);

        $client->followRedirect();
        $this->assertResponseIsSuccessful($message = 'Superbe ! L\'utilisateur a bien été ajouté.');
    }


}
