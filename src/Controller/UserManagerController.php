<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
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
}
