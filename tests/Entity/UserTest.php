<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testvalidEntity()
    {
        $code = (new User())
            ->setUsername("user test")
            ->setEmail("mailtest@gmail.com")
            ->setPassword("bibitest")
            ->setRoles(["ROLE_USER"]);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($code);
        $this->assertCount(0, $error);
    }
    public function testgetterEntity(){
        $user = new User();
        $task = new Task();
        $user->setUsername("user0");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$VVdtN1BuR0wwcFpnNWkvVQ$R3WYdwlMEx1/dlP1+MXEqYuTU9x1Pc73vmQLvnia42g');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setEmail("user0@gmail.com");
        $user->addTask($task);
        self::assertSame("user0",$user->getUsername());
        self::assertSame('$argon2id$v=19$m=65536,t=4,p=1$VVdtN1BuR0wwcFpnNWkvVQ$R3WYdwlMEx1/dlP1+MXEqYuTU9x1Pc73vmQLvnia42g',$user->getPassword());
        self::assertSame("user0@gmail.com",$user->getEmail());
        self::assertSame(["ROLE_ADMIN","ROLE_USER"],$user->getRoles());
//        self::assertSame(self::objectEquals(),$user->getTasks());

    }

}
