<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function __construct()
    {
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessfulWhenConnected($url, $expectedStatus)
    {

        $client = self::createClient();
        $userRepository = $manager->getRepository(User::class);
        $userRepository->findOneBy(['userName' => 'user0']);
        $client->request('GET', $url);
        $this->assertResponseStatusCodeSame($expectedStatus);
    }

    public function urlProvider(): \Generator
    {
        yield "login" => ['/login', 200];
//        yield "homepage" => ['/', 200];
//        yield "list tasks" => ['/tasks', 200];
//        yield "task create" => ['/tasks/create', 200];
//        yield "task edit" => ['/tasks/edit/1',302];
//        yield "task toggle" => ['/tasks/toggle/1', 200];
//        yield "task delete" => ['/tasks/delete/1', 302];
//        yield "users list" => ['/admin/users', 403];
//        yield "users create" => ['/admin/users/create', 403];
//        yield "users edit" => ['/admin/users/1/edit', 403];
//
    }

//    /**
//     * @dataProvider urlProviderTest
//     */
//    public function testPageIsSuccessfullWhenNoConnected($url, $expectedStatus, $expectedRedirect = null)
//    {
//
//        $client = self::createClient();
//
//
//        $client->request('GET', $url);
//
//        $this->assertResponseStatusCodeSame($expectedStatus);
//
//        if ($expectedRedirect) {
//            $this->assertResponseRedirects($expectedRedirect);
//        }
//    }
//
//    public function urlProviderTest()
//    {
//        yield "login" => ['/login', 200];
//        yield "homepage" => ['/', 200];
//        yield "list tasks" => ['/tasks', 200];
//        yield "task create" => ['/tasks/create', 200];
//        yield "task edit" => ['/tasks/edit/1',302];
//        yield "task toggle" => ['/tasks/toggle/1', 200];
//        yield "task delete" => ['/tasks/delete/1', 302];
//        yield "users list" => ['/admin/users', 403];
//        yield "users create" => ['/admin/users/create', 403];
//        yield "users edit" => ['/admin/users/1/edit', 403];

//    }
}
