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
            ->setUser($user)
        ;
        self::bootKernel();
        $error = self::$container->get('validator')->validate($code);
        $this->assertCount(0, $error);
    }

}
