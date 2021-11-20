<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{

    const VIEW_USER = 'VIEW_USER';
    const EDIT_USER = 'EDIT_USER';
    const CHANGE_ROLE_USER = 'CHANGE_ROLE_USER';

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['VIEW_USER', 'EDIT_USER', 'CHANGE_ROLE_USER'])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::VIEW_USER:
            case self::EDIT_USER:
            case self::CHANGE_ROLE_USER:
        }

        return false;
    }

}
