<?php

//namespace App\Tests\Repository;
//
//use App\DataFixtures\AppFixtures;
//use App\Repository\UserRepository;
//use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
//use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//
//class UserRepositoryTest extends WebTestCase
//{
//    /** @var AbstractDatabaseTool */
//    protected $databaseTool;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//
//        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
//    }
//
//    public function testIndex()
//    {
//
//        $this->databaseTool->loadFixtures([AppFixtures::class]);
//        $users = self::$container->get(UserRepository::class)->count([]);
//        $this->assertEquals(6, $users);
//    }
//}