<?php

namespace App\Security\Voter;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskVoter extends Voter
{

    const TASK_EDIT = 'TASK_EDIT';

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::TASK_EDIT])
            && $subject instanceof \App\Entity\Task;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        // ... (check conditions and return true to grant permission) ...
       $task = $subject;
        switch ($attribute) {

            case self::TASK_EDIT:
                if (!empty($user)) {
                    return $this->canEdit($task, $user);
                }
        }

        throw new \LogicException('This code should not be reached!');
    }


    private function canEdit(Task $task, User $user): bool
    {
        // this assumes that the Post object has a `getOwner()` method
        if ($user->getRoles()[0]==="ROLE_ADMIN"){
            return true;
        }
        if ($user->getId() == $task->getUser()->getId()) {
            return true;
        }

        return false;
    }
}
