<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

trait Login
{
    private ?\Symfony\Bundle\FrameworkBundle\KernelBrowser $client = null;
    private $entityManager;


    public function logIn($client)
    {

        $session = $client->getContainer()->get('session');

        // somehow fetch the user (e.g. using the user repository)
        $userRepository = $this->entityManager->getRepository(User::class);
        /**
         * @var UserRepository
         */
        $user = $userRepository->findOneBy(['userName' => 'user0']);
        $firewallName = 'main';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'main';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken($user, null, $firewallName, $user->getRoles());
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}