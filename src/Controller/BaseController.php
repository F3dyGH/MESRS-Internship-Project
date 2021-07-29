<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Security\EmailVerifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class BaseController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;
    private $emailVerifier;

    public function __construct(Security $security, EmailVerifier $emailVerifier)
    {
        $this->security = $security;
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function indexBack(): Response
    {
        return $this->render('BackOffice/base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/home", name="educati")
     */
    public function indexFront(UserInterface $user, Request $request): Response
    {
        $u = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($u);

        if ($user->IsVerified() == false) {
            $this->addFlash('alert', 'Please verify your email to activate your account and enjoy our features,');
            /*if ($request) {
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('infos@educati.com', 'Educati-infos'))
                        ->to($user->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('FrontOffice/registration/confirmation_email.html.twig')
                );
            }*/
        }
        return $this->render('FrontOffice/base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
    /**
     * @Route ("verify", name="verify")
     */
    public function verify(){
        $u = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($u);
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('infos@educati.com', 'Educati-infos'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('FrontOffice/registration/confirmation_email.html.twig')
        );
        return $this->render('FrontOffice/verify_mail.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
