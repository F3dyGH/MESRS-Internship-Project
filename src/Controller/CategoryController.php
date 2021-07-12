<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/add", name="add_category")
     */
    public function add(Request $request): Response
    {
        $cat = new Category();
        $form = $this->createForm(CategoryType::class,$cat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('list_category');
        }
        return $this->render('BackOffice/category/add.html.twig', [
            'controller_name' => 'CategoryController',
            "form_title" => "Add Category",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route ("admin/category/list", name="list_category")
     */
    public function list(){
        $cat = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render("BackOffice/category/list.html.twig",[
            "category"=>$cat,
        ]);
    }
    /**
     * @Route("admin/category/delete/{id}", name="delete_category")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cat = $entityManager->getRepository(Category::class)->find($id);
        $entityManager->remove($cat);
        $entityManager->flush();
        return $this->redirectToRoute('list_category');
    }
    /**
     * @Route("admin/category/edit/{id}", name="edit_category")
     */
    public function edit(Request $request, int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $cat = $entityManager->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryType::class,$cat);
        $form->handleRequest($request);


        if($form->isSubmitted()&& $form->isValid())
        {

            $entityManager = $this->getDoctrine()->getManager();



            $entityManager->flush();

            return $this->redirectToRoute('list_category');

        }

        return $this->render("BackOffice/category/edit.html.twig", [
            "form_title" => "Modifier vos informations",
            "form" => $form->createView(),
        ]);
    }
}
