<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Instructor;

class InstructorController extends AbstractController
{
    public function roles(UserInterface $user, Instructor $instructor): void
    {

        if ($user->getRoles() == ['ROLE_INST']) {
            $instructor->setInst($user->getId());
        }
    }
}
