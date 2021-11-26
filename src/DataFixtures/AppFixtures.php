<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    const NB_USERS = 5;
    const NB_TASKS = 10;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        while ($i <= self::NB_USERS) {
            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'bibi'));
            $user->setEmail('user' . $i . '@gmail.com');
            if ($i == 0) {
                $user->setUsername('user'.$i);
                $user->setRoles(["ROLE_ADMIN"]);
            } elseif($i == 1) {
                $user->setUsername('anonymous');
                $user->setRoles(["ROLE_USER"]);
            }else{
                $user->setUsername('user'.$i);
                $user->setRoles(["ROLE_USER"]);

            }
            $manager->persist($user);
            $i++;
        }

        $manager->flush();
    }



}
