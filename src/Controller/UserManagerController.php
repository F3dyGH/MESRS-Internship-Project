<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\LoginAuthenticator;
use App\Form\UserRoleType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class UserManagerController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security,EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/admin/users", name="user_manager")
     */
    /* public function index(): Response
     {
         return $this->render('user_manager/list.html.twig', [
             'controller_name' => 'UserManagerController',
         ]);
     }*/
    public function list()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render("BackOffice/users/list.html.twig", [
            "users" => $user,
        ]);
    }

    /**
     * @Route("admin/users/edit/{id}", name="edit_role")
     */
    public function edit(Request $request, int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(UserRoleType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            // move_uploaded_file($_FILES['image',''])
            $entityManager->flush();

            return $this->redirectToRoute('user_manager');

        }
        return $this->render("BackOffice/users/edit.html.twig", [
            "form_title" => "Modifier vos informations",
            "userForm" => $form->createView(),
        ]);
    }

    /**
     * @Route ("/profile" , name="profile")
     */
    public function profile(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $u = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($u);
        $hasAccess = $this->isGranted('ROLE_INST');
        if ($hasAccess) {
            return $this->render("FrontOffice/profile/InstProfile.html.twig");
        } else {
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                // move_uploaded_file($_FILES['image',''])
                //$entityManager->flush();
                // Encode the plain password, and set it.
                $encodedPassword = $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                );

                $user->setPassword($encodedPassword);
                $entityManager->flush();
                $this->addFlash('success', 'Informations Updated!');
            }
            return $this->render("FrontOffice/profile/StudProfile.html.twig", [
                "form_title" => "Edit infos",
                "userEditForm" => $form->createView(),
            ]);

        }
    }
//    /**
//     *@Route ("/profile" , name="instprofile")
//     */
//    public function profile(){
//        return $this->render("FrontOffice/profile/InstProfile.html.twig");
//    }

}
