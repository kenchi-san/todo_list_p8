<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{

    public function testvalidEntity()
    {
        $user = new User();
        $code = (new Task())
            ->setTitle("test titre")
            ->setContent("mon contenue")
            ->setIsDone(true)
            ->setUser($user);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($code);
        $this->assertCount(0, $error);
    }

    public function testgetterEntity(){
        $task = new Task();
        $user = new User();
       $task->setUser($user->setUsername("user0"));
       $task->setIsDone(true);
       $task->setContent("test content");
       $task->setTitle("title test");
       $task->setCreatedAt(\date_create_immutable());
        self::assertSame("user0",$task->getUser()->getUsername());
        self::assertSame("title test",$task->getTitle());
        self::assertSame("test content",$task->getContent());
        self::assertSame(true,$task->getIsDone());
        self::assertSame(\date_create_immutable(),$task->getCreatedAt());
    }
}
